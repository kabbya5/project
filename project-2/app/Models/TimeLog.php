<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TimeLog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'project_id', 'start_time', 'end_time', 'manual_hours', 'description', 'tag'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function scopeFilter($query, Request $request){
        $date = $request->date;
        $type = $request->type;

        if($type == 'day'){
            $query->whereDate('start_time',$date);
        }

        if($type == 'week'){

            $date = Carbon::parse($date);

            $start_of_week = $date->copy()->startOfWeek()->setTime(0, 0, 0);
            $end_of_week = $date->copy()->endOfWeek()->setTime(23, 59, 59);

            $query->whereBetween('start_time', [$start_of_week, $end_of_week]);
        }

        return $query->where('user_id', auth()->id());
    }
}
