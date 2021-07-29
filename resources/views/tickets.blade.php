@extends('layouts/layout')


@section('content')
    <h1>Fresdesk Tickets:</h1> 
    @foreach($tickets as $ticket)
        <li>{{$ticket}}</li>
    @endforeach

@endsection

