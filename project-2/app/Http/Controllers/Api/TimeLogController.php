<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateTimeLogReportPdf;
use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    public function index(Request $request){
        $time_logs = TimeLog::filter($request)->latest()->paginate(50);

        return response()->json(['time_logs' => $time_logs]);
    }

    public function store(Request $request){
        $timeLog = TimeLog::create(
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'description' => 'nullable|string|max:255',
                'start_time' => 'required|date_format:Y-m-d H:i:s',
            ]) + ['user_id' => auth()->id()]
        );

        return response()->json(['timelog' => $timeLog, 'message' => "Time log created successfully"]);
    }

    public function update(Request $request, TimeLog $time_log){
        $time_log->update($request->validate([
            'project_id' => 'required|exists:projects,id',
            'hours' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'tag' => 'in:billable,non-billable',
        ]));
    }

    public function end(TimeLog $time_log){

        $end = Carbon::now();

        $start = Carbon::parse($time_log->start_time);
        $diffInSeconds = $end->timestamp - $start->timestamp;

        $time_log->hours = round($diffInSeconds / 3600, 2);
        $time_log->end = $end;

        return response()->json(['timelog' => $time_log, 'message' => "Time log update successfully"]);
    }

    public function generatePdf(Request $request){
        $date = $request->date;
        $project_id = $request->project_id;
        $user_id = 1;
        GenerateTimeLogReportPdf::dispatch($date, $project_id, $user_id);

        return response()->json(['message' => 'The report pdf processing. after complete it you will get message']);
    }
}
