<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Ticket;
use DB;


class TicketsController extends Controller
{
    //
    public function list_freshdesk()
    {

        $tickets = TicketsController::tickets_get();

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


    private function token_get()
    {
        /*
             API ključ je shranjen v datoteki (.api_key)
             Prebere ključ in ga vrne
        */
        $token_filename = '../.api_key';
        $token_file = fopen($token_filename, "r");
        $api_token = fread($token_file, filesize($token_filename));
        fclose($token_file);
        return trim($api_token);
    }


    public function tickets_get()
    {
        $url_domain = 'https://timibozic.freshdesk.com/helpdesk/';
        $url_api = 'tickets.json'; # api url (za ticket), lahko .json ali .xml
        $url_full = $url_domain . $url_api;
        $api_token = TicketsController::token_get();

        // Preveri če je spletna stran dosegljiva
        if ( (Http::get($url_full)->status()) == 200)
        {
        
            /*
                pošlje zahtevo za podatke z API ključem, če uporabimo API ključ 
                geslo ni potrebno
             */
            $resp = Http::withBasicAuth($api_token, "abadba")->get($url_full);
            
            // pretvori podatke v JSON obliko
            return $resp->json();
        }

    }


    public function tickets_store()
    {
        /*
            Preki API dobi vse ticekete in jih doda v bazo
        */
        $tickets = TicketsController::tickets_get();

        foreach ($tickets as $ticket)
        {
            $temp = new Ticket;
            $temp->name = $ticket['subject'];
            $temp->save();
        }
       return back();
    }


    public function tickets_delete_all()
    {
        /*
            Izprazni bazo
        */
        DB::delete("DELETE FROM Tickets");

        return back();
    }
}
