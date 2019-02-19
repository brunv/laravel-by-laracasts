<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class ProjectTasksController extends Controller
{
    // usando Wrap Model Binding:
    public function update(Task $task)
    {
        // dd(request()->all());
        $task->update([
            'completed' => request()->has('completed')
        ]);

        return back();  // redireciona para a última página acessada anteriormente
    }
}
