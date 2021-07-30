@extends('layouts/layout')



@section('content')
    <h1>Fresdesk Tickets:</h1> 
    @foreach($tickets as $ticket)
        <div class="ticket">
            <h3>{{$ticket['subject']}}</h3>
            <p>
                {{$ticket['description']}}<br>
                {{$ticket['id']}}<br>
            </p>
            <?php
                print_r($ticket);
            ?>
        </div>
    @endforeach

@endsection

