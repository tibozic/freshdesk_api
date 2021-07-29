@extends('layouts/layout')


@section('content')
    <h1>Database Tickets:</h1>
    @foreach($tickets as $ticket)
        <li>{{$ticket->name}}</li>
    @endforeach
@endsection
