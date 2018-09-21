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
        Commands\Autotread::class,
        Commands\PendingTransactionEmail::class,
        Commands\UpdateKycInformation::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        $file = 'command1_mail_output.log';
        $schedule->command('command:autotread')->everyMinute();
        $schedule->command('command:PendingTransactionEmail')->hourly();
        $schedule->command('command:UpdateKycInformation')
        ->timezone('US/Eastern')
        ->at('01:00');
        //$schedule->call('App\Http\Controllers\SettingController@rate_active_cron')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
