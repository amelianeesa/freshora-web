<?php

namespace App\Models;

use CodeIgniter\Model;

class MUserToken extends Model
{
    protected $table         = 'user_token';
    protected $allowedFields = ['user_id', 'auth_key'];
}