<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    // usando Route Model Binding:
    public function update(Task $task)
    {
        // dd(request()->all());
        $task->update([
            'completed' => request()->has('completed')
        ]);

        return back();  // redireciona para a última página acessada anteriormente
    }

    public function store(Project $project)
    {
        // Task::create([
        //     'project_id' => $project->id,
        //     'description' => request('description')
        // ]);
        // return back();

        $validated = request()->validate(['description' => 'required|max:255']);
        $project->addTask($validated);

        return back();
    }
}
