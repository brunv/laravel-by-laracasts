<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Mail\ProjectCreated;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // aplica para todos os métodos

        // $this->middleware('auth')->only(['store', 'update', 'create']); // aplica para os métodos listados

        // $this->middleware('auth')->except(['show']); // aplica para todos os métodos exceto os listados
    }

    public function index()
    {
        // $projects = Project::all();

        // auth()->id() retorna id do usuário
        // auth()->user() retorna objeto do usuário
        // auth()->check() retorna boolean se está logado ou não
        // aith()->geust() verifica se é convidado ou não

        $projects = auth()->user()->projects;
        // $projects = Project::where('owner_id', auth()->id())->get(); // select * from projects where owner_od = id do user logado

        // Com telescope podemos armazenar dados que são usados com frequência e que não se alteram com frequência, para que não seja feita sempre a mesma requisição custosa. Exemplo:
        // cache()->rememberForever('stats', function () {
        //     return ['lessons' => 32, 'hours' => 6, 'series' => 10];
        // });
        // $stats = cache()->get('stats');

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // route model binding
        // ou:
        // $project = Project::findOrFail($id);
        // return $project;

        // Usuário acessa somente seus próprios projetos:
        // if ($project->owner_id !== auth()->id()) {
        //     abort(403);
        // }
        // abort_if($project->owner_id !== auth()->id(), 403); // usando esse helper
        // abort_unless(auth()->user()->owns($project), 403);

        // Utilizando Policy:
        // todos os Controllers podem acessar o método Authorize():
        $this->authorize('view', $project);

        // Utilizando Gate Facade do Laravel:
        // \Gate::allows ou:
        // if (\Gate::denies('view', $project)) {
        //     abort(403);
        // }
        // abort_unless(\Gate::allows('update', $project), 403);

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
        $validated = $this->validateProject();

        $validated['owner_id'] = auth()->id();

        // MassAssignment:
        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);
        $project = Project::create($validated);
        // Project::create($validated + ['owner_id' => auth()->id()]);

        // $project = new Project();
        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();

        // Mailing:
        \Mail::to($project->owner->email)->send(
            new ProjectCreated($project)
        );

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

        // $validated = request()->validate([
        //     'title' => 'required|min:3',
        //     'description' => ['required', 'min:10']
        // ]);
        // $project->update(request(['title', 'description']));

        $project->update($this->validateProject());

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        // dd('hi');
        // Project::findOrFail($id)->delete();

        $project->delete();

        return redirect('/projects');
    }

    public function validateProject()
    {
        return $validated = request()->validate([
            'title' => 'required|min:3',
            'description' => ['required', 'min:10']
        ]);
    }
}
