<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function projectReport(Request $request){

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $client_id = $request->client_id;

        $projects = DB::table('projects')
            ->join('time_logs', 'time_logs.project_id', '=', 'projects.id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->when($from_date && $to_date, function($query) use($from_date, $to_date){
                $query->whereBetween('start_time', [$from_date, $to_date]);
            })->when($from_date && !$to_date, function($query) use($from_date){
                $query->whereDate('start_time',$from_date);
            })->when(!$from_date && $to_date, function($query) use($to_date){
                $query->whereDate('start_time', $to_date);
            })->when($client_id, function($query) use($client_id){
                $query->where('clients.id', $client_id);
            })
            ->select(
                'projects.id as project_id',
                'projects.title as project',
                'clients.name as client_name',
                'clients.id as client_id',
                DB::raw('SUM(CASE WHEN time_logs.hours IS NOT NULL THEN time_logs.hours ELSE 0 END) as total_hours')
            )
            ->groupBy('projects.id','clients.id','projects.title','clients.name')
            ->get();

        return response()->json(['projects', $projects]);
    }
}
