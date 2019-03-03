<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\DoSomethingElse;

class CompileReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reportId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reportId)
    {
        $this->reportId = $reportId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        var_dump('Compiling the report with the id '. $this->reportId .' within the Job Class.');

        // Como podemos disparar esses Jobs?
        // Pelo controller ou através de qualquer classe do sistema.

        // Em Jobs podemos disparar outros Jobs ou Events
        // event(new ReportWasCompiled);
        if (true) {
            dispatch(new DoSomethingElse);
        }
    }
}
