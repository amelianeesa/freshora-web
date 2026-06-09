<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    
    // Pastikan 'laundry_photo' ada di sini
    protected $allowedFields    = [
        'user_id', 'service_name', 'fullname', 'whatsapp', 'address', 
        'pickup_time', 'notes', 'promo_code', 'resi_code', 'status', 
        'payment_method', 'weight', 'total_price', 'laundry_photo', 'payment_proof', 
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
}