@extends('layout')

@section('content')
    <h1 class="title">{{ $project->title }}</h1>

    <div class="content">
        {{ $project->description }}
    
        <p style="margin-top:30px">
            <a href="{{ url('projects/'.$project->id.'/edit') }}">Edit</a>
        </p>
    </div>

    @if ($project->tasks->count())
        <div class="box">
            @foreach($project->tasks as $task)
            <div>
                <form action="{{ url('tasks/'.$task->id)}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <label class="checkbox {{ $task->completed ? 'is-complete' : ''}}" for="completed">
                        <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        {{ $task->description }}
                    </label>
                </form>
            </div>
            @endforeach
        </div>
    @endif

    <form action="{{ url('projects/'.$project->id.'/tasks') }}" method="POST" class="box">
        @csrf

        <div class="field">
            <label for="description">New Task</label>

            <div class="control">
                <input type="text" name="description" class="input" placeholder="New Task" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Task</button>
            </div>
        </div>

        @include('errors')
    </form>

@endsection