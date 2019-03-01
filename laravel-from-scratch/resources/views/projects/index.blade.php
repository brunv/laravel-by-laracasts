@extends('layout')

@section('content')
    <h1 class="title">Projects</h1>

    @if (session('feedback'))
        <p>{{ session('feedback') }}</p>
    @endif

    <ul>
    @foreach ($projects as $project)
        <li><a href="{{ url('projects/'.$project->id) }}">{{$project->title}}</a></li>
    @endforeach
    </ul>

@endsection