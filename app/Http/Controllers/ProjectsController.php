<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        // $projects = auth()->user()->projects();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {   
        return view('projects.create');
    }

    public function store()
    {
        $project = new Project();

        $project->title = request('title');
        $project->description = request('description');

        $project->save();
        return redirect('/projects');
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('projects.edit', compact('project'));
    }

    public function update($id)
    {
        // dd(request()->all());
        // dd é "die and dump"

        $project = Project::find($id);

        $project->title = request('title');
        $project->description = request('description');

        $project->save();

        return redirect('/projects');
    }
}
