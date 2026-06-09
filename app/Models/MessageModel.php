<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'whatsapp', 'message', 'created_at'];
    protected $useTimestamps    = true; 
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; 
}