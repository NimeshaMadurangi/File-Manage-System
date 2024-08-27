<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table            = 'events';
    protected $primaryKey       = 'event_id';
    protected $allowedFields = ['eventname', 'description', 'user_id', 'username', 'created_at'];
}
