<?php

namespace App\Console\Commands;

use App\Models\TimeLog;
use App\Notifications\DailyTimeLogNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class sendDailyHoursEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-hours-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eightHoursAgo = Carbon::now()->subHours(8);

        $timeLogs = TimeLog::where('start_time', '>=', $eightHoursAgo)
            ->whereNull('end_time')
            ->get();

        foreach($timeLogs as $log){
            if($log->user){
                $log->user->notify(new DailyTimeLogNotification($log));
            }
        }
    }
}
