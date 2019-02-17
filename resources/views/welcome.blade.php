@extends('layout')

@section('content')
    <h1>My {{$foo}} first website </h1>

    <ul>
    @foreach ($tasks as $task)
        <li>{{$task}}</li>
    @endforeach
    </ul>

@endsection

<!-- 
    A sintaxe {{  filtra o conteúdo impedindo que seja exibido html ou javascript.
    Para evitar essa filtragem, podemos usar {!!  para ter total controle.
-->