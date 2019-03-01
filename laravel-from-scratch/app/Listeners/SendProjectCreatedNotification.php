<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\ProjectCreated;
use App\Mail\ProjectCreated as ProjectCreatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

// NOTE Listeners respondem aos eventos disparados
// Para acessar atributos do Evento, use $event->$_item_

class SendProjectCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProjectCreated  $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        Mail::to($event->project->owner->email)->send(
            new ProjectCreatedMail($event->project)
        );
    }
}
