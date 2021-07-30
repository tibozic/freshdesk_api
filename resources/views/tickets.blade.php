@extends('layouts/layout')



@section('content')
    <h1>Fresdesk Tickets:</h1> 
    <p>Tukaj so izpisani vsi ticketi ki se nahajajo v Freshdesk.</p>
    <table border=1 class="table">

        <tr>
            <th>Naslov</th><th>Zadnja posodobitev</th><th>Prioriteta</th><th>Status</th><th>Opis<th>
        </tr>
        @foreach($tickets as $ticket)
        <tr>
            <td>{{$ticket['subject']}}</td>
            <td>{{$ticket['updated_at']}}</td>
            <td>{{$ticket['priority']}}</td>
            <td>{{$ticket['status']}}</td>
            <td>{{$ticket['description']}}</td>
        </tr>
    @endforeach
    </table>
@endsection

