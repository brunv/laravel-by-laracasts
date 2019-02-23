<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
// use App\Mail\ProjectCreated;
use App\Events\ProjectCreated;

class Project extends Model
{
    // Permitir MassAssignment:
    protected $fillable = [
        'title',
        'description',
        'owner_id'
    ];

    // REVIEW Utilizando o próprio evento 'created' do Eloquent:
    // Não se esqueça de registrar o Listener em EventServiceProvider caso
    // esteja utilizando o respecivo Listener.
    protected $dispatchesEvents = [
        'created' => ProjectCreated::class
    ];

    // REVIEW Model Hooks for a small event
    // protected static function boot()
    // {
    //     parent::boot();

    //     // o método 'created' só é acessado depois que o projeto for criado e
    //     // inserido no banco de dados
    //     static::created(function ($project) {

    //         // Mailing:
    //         Mail::to($project->owner->email)->send(
    //             new ProjectCreated($project)
    //         );
    //     });
    // }

    // Ao contrário do anterior, não permita MassAssignment em:
    // protected $guarded = [
    //     'title',
    //     'description'
    // ];
    // Se deixado vazio, ele libera tudo para MassAssingment.

    // Caso $guard esteja vazio (ou seja, aceita MassAssignment em tudo), é possível
    // passar parâmetros (pelo formulário) que não existam ou mesmo que alterem dados
    // que não eram para serem alterados, um $id, por exemplo.

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        // return Task::create([
        //     'project_id' => $this->id,
        //     'description' => $description
        // ]);

        // esse método já associa a tarefa com o 'project_id' correto, mas ainda
        // não impede que seja manipulado pelo formulário.
        $this->tasks()->create($task);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
