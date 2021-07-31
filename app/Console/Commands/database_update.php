<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TicketsController;

class database_update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posodobi podatkovno bazo, klicano vsako minuto preko Laravel Scheduler';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*
            Ustvarimo nov pojav controllerja, da lahko kličemo funkcijo za
            posodobitev baze
        */
        $TicketsController = new TicketsController();
        $TicketsController->database_update();
        return 0;
    }
}
