@extends('layout')

@section('content')
    <h1 class="title">Create a new project:</h1>

    <form action="{{ url('projects') }}" method="POST">
        {{ csrf_field() }}
        <div class="field">
            <label for="title" class="label">Project Title</label>
            <div class="control">
                <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : ''}}" name="title" value="{{ old('title') }}">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">Project Description</label>
            <div class="control">
                <textarea name="description" class="textarea {{ $errors->has('description') ? 'is-danger' : ''}}">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create</button>
            </div>
        </div>

        <!-- Errors é um objeto e pode ser sempre acessado. -->
        @if($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
@endsection