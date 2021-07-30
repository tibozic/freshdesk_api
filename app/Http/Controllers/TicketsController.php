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
        /*
            Z pomočjo Freshdesk API izpiše vse tickete
        */
        $tickets = TicketsController::tickets_get();

        return view('tickets', [
            'tickets'  => $tickets,
        ]);
       
    }


    public function list_database()
    {
        /*
            Iz podatkovne baze izpiše vse vnose 
        */
        $tickets = DB::table('Tickets')->orderBy('created_at', 'desc')->get();

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
        /*
            Z pomočjo Freshdesk API pridobi vse tickete in jih vrne v JSON
            obliki
        */
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

    
    public function ticket_store($ticket)
    {
        /*
           Preko vhoda dobi ticket in ga sharni v bazo 
        */

        DB::table('Tickets')->insert([
             'id' => $ticket['id'],
             'name' => $ticket['subject'],
             'description' => $ticket['description'],
             'requester' => $ticket['requester_name'],
             'responder' => $ticket['responder_name'],
             'status' => $ticket['status'],
             'priority' => $ticket['priority'],
             'due_by' => $ticket['due_by'],
             'created_at' => (string) $ticket['created_at'],
             'updated_at' => (string) $ticket['updated_at'],
        ]);

        return back();
    }


    public function tickets_delete_all()
    {
        /*
            Izprazni bazo
        */
        DB::table('Tickets')->delete();

        return back();
    }


    public function ticket_update($ticket)
    {
        /*
            Kot vhod dobi podatke o ticketu, ki ga je potrebno posodobiti in
            ga posodobi
        */
        DB::table('Tickets')
            ->where('id', $ticket['id'])
            ->update([
                'name' => $ticket['subject'],
                'description' => $ticket['description'],
                'requester' => $ticket['requester_name'],
                'responder' => $ticket['responder_name'],
                'status' => $ticket['status'],
                'priority' => $ticket['priority'],
                'due_by' => $ticket['due_by'],
                'created_at' => (string) $ticket['created_at'],
                'updated_at' => (string) $ticket['updated_at'],
            ]);


        return back();
    }


    public function database_update()
    {
        /*
            Z pomočjo Freshdesk API pridobi vse tickete in pregleda
            če so že v bazi. 
        */
        $tickets = TicketsController::tickets_get();

        foreach ($tickets as $ticket)
        {
            
            // Preveri če je ticket v bazi
            $instance = DB::table('Tickets')->find($ticket['id']);
            if ($instance === null)
            {
                /*
                    Če ticketa ni v bazi kliče funkcijo ki ga v bazo doda.
                 */
                TicketsController::ticket_store($ticket);
            }
            else
            {

                /*
                    Če je ticket v bazi primerja datum zadnje spremembe, če je potrebno 
                    ticket posodobi.
                */
                if ($instance->updated_at < $ticket['updated_at'])
                {
                    TicketsController::ticket_update($ticket);
                }

            }
        }


        return back();
    }
}
