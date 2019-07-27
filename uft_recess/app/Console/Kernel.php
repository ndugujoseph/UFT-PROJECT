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
        

        Commands\MemberUpload::class,
        Commands\MemberNum::class,
        Commands\AgentNum::class,
        Commands\PaymentUpdate::class,
        Commands\MemberRec::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('member:upload')
        ->cron('* * * * *');
        $schedule->command('member:number')
        ->cron('* * * * *');
        $schedule->command('agent:number')
        ->cron('* * * * *');
        $schedule->command('pay:update')
        ->cron('* * * * *');
        $schedule->command('rec:number')
        ->cron('* * * * *');



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
