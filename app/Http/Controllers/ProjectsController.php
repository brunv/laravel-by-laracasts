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
        // Caso $guarded esteja vazio (ou seja, aceita MassAssignment em tudo), é possível
        // passar parâmetros (pelo formulário) que não existam ou mesmo que alterem dados
        // que não eram para serem alterados, um $id, por exemplo.
        
        // dd(request()->all());
        // dd(request('title'));
        // dd(request(['title', 'description']));
        // dd([
        //     'title' => resquest('title'),
        //     'description' => request('description')
        // ]);

        // Se tudo for válido retorna os atributos validados:
        $validated = request()->validate([
            'title' => 'required|min:3',
            'description' => ['required', 'min:10']
        ]);

        // MassAssignment:
        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);
        Project::create($validated);

        // $project = new Project();
        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();

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

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();

        $project->update(request(['title', 'description']));

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
