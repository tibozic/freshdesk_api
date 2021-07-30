@extends('layouts/layout')


@section('content')
    <h1>Database Tickets:</h1>
    <p>Tukaj so prikazani vsi ticketi ki se nahajajo v podatkovni bazi</p>
    <a href="update"><button type="button" class="btn btn-primary">Posodobi bazo</button></a>
    <a href="delete"><button type="button" class="btn btn-danger">Izprazni bazo</button></a>
    <br><br>
    <table border=1 class="table">

        <tr>
            <th>Naslov</th><th>Zadnja posodobitev</th><th>Prioriteta</th><th>Status</th><th>Opis<th>
        </tr>
        @foreach($tickets as $ticket)
        <tr>
            <td>{{$ticket['name']}}</td>
            <td>{{$ticket['updated_at']}}</td>
            <td>{{$ticket['priority']}}</td>
            <td>{{$ticket['status']}}</td>
            <td>{{$ticket['description']}}</td>
        </tr>
    @endforeach
    </table>
@endsection
