<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Send exam reminders every minute (checks for exams starting in the next hour)
        $schedule->command('exam:send-reminders')
            ->everyMinute()
            ->withoutOverlapping()
            ->onFailure(function () {
                \Log::error('Failed to send exam reminders');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
