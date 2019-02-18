<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Permitir MassAssignment:
    protected $fillable = [
        'title',
        'description'
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
}
