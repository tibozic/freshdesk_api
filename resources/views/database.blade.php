@extends('layouts/layout')


@section('content')
    <h1>Database Tickets:</h1>
    <a href="update"><button type="button" class="btn btn-primary">Posodobi bazo</button></a>
    <a href="delete"><button type="button" class="btn btn-danger">Izprazni bazo</button></a>
    @foreach($tickets as $ticket)
        <h3>{{$ticket->name}}</h3>
    @endforeach
@endsection
