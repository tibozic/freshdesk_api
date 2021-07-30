<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'Tickets';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $name;
    public $description;
    public $requester;
    public $responder;
    public $status;
    public $priority;
    public $last_update;
    public $created;
    public $due_by;

    protected $attributes = [
        'name' => "",
        'description' => "",
        'requester' => "",
        'responder' => "",
        'status' => "",
        'priority' => "",
        'last_update' => "",
        'created' => "",
        'due_by' => ""
    ];


    protected $connection = 'sqlite';
 
}
