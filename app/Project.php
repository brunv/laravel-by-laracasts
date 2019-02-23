<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Permitir MassAssignment:
    protected $fillable = [
        'title',
        'description',
        'owner_id'
    ];

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
