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
    public $title;
    public $description;
    public $requester;
    public $responder;
    public $status;
    public $priority;
    public $updated_at;
    public $created_at;

    protected $connection = 'sqlite';
 
}
