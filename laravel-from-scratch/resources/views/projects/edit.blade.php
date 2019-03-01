@extends('layout')

@section('content')
    <h2 class="title">Edit Project</h2>

    <form action="{{ url('projects/'.$project->id) }}" method="POST">
    <!-- 
        Os navegadores não suportam método PATCH diretamente. Então mantemos o método
        POST e enviamos um campo extra para que Laravel interprete como PATCH.
    -->
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="field">
            <label for="title" class="label">Title</label>
            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title }}">
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
                <textarea class="textarea" name="description">{{ $project->description }}</textarea>
            </div>
        </div>
        
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button>
            </div>
        </div>

    </form>

    @include('errors')

    <form action="{{ url('projects/'.$project->id) }}" method="POST">
        @method('DELETE')
        @csrf

        <div class="field">
            <div class="control">
                <button type="submit" class="button">Delete Project</button>
            </div>
        </div>
    </form>
@endsection