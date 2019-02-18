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
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    public function update($id)
    {
        // dd(request()->all());
        // dd é "die and dump"

        $project = Project::findOrFail($id);

        $project->title = request('title');
        $project->description = request('description');

        $project->save();

        return redirect('/projects');
    }

    public function destroy($id)
    {
        // dd('hi');
        Project::findOrFail($id)->delete();

        return redirect('/projects');
    }
}
