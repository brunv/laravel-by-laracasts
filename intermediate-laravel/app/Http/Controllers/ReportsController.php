<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CompileReports;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // $job = new CompileReports($request->input('reportId'));
        // $this->dispatch($job);

        // $this->dispatchFrom('App\Jobs\CompileReports', $request); Não funciona no Laravel recente

        CompileReports::dispatch($request->input('reportId'));

        return $request->input;
    }
}
