<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cache:clear')->dailyAt('08:40');
        $schedule->command('view:clear')->dailyAt('08:40');
        $schedule->call('App\Http\Controllers\TotalAnalytics@index')->dailyAt('08:41');
        $schedule->call('App\Http\Controllers\AnalyticsNhV@runSchedule')->dailyAt('08:43');
        $schedule->command('minute:update')->dailyAt('08:50');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
