<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketsController extends Controller
{
    //
    public function list_freshdesk()
    {

         $tickets = [
            'Ticket 1',
            'Ticket 2',
            'Ticket 3',
            'Ticket 4',
        ];

        return view('tickets', [
            'tickets'  => $tickets,
        ]);
       
    }


    public function list_database()
    {
        $tickets = Ticket::all();        

        return view('database', [
            'tickets'  => $tickets,
        ]);
       
    }
}
