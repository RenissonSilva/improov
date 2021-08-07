<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ChangeMissionStatusCron::class,
        Commands\RepeatMission::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('changestatus')->daily();
        $schedule->command('mission:repeat')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
