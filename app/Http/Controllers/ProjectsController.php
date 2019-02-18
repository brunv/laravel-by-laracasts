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

    public function show(Project $project)
    {
        // $project = Project::findOrFail($id);

        // wrap model binding
        // return $project;

        return view('projects.show', compact('project'));
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

    public function edit(Project $project)
    {
        // $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        // dd(request()->all());
        // dd é "die and dump"

        // $project = Project::findOrFail($id);

        $project->title = request('title');
        $project->description = request('description');

        $project->save();

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        // dd('hi');
        // Project::findOrFail($id)->delete();

        $project->delete();

        return redirect('/projects');
    }
}
