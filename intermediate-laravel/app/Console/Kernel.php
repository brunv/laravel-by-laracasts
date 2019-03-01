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
        // disparando comandos do artisan:
        // $schedule->command('inspire')
        //          ->hourly();

        // disparando comandos normais de terminal:
        // $schedule->exec("touch foo.txt")->everyFiveMinutes();

        // everyTenMinutes ou everyFiveMinutes é criado por um helper, mas é limitado
        // há outras maneiras de setar tempos distintos. Há uma lista na documentação

        //exemplos:
        $schedule->command('laracasts:clear-history')->monthly()->sendOutputTo('path/to/file')->emailOutputTo('email@email.com');
        // obs: para enviar por e-mail é necessário salvar o output em algum lugar antes
        $schedule->command('laracasts:daily-report')->dailyAt('23:55');
        $schedule->command('laracasts:daily-report')->monthly()->thenPing('url');
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
