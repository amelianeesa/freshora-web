<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'service_name', 'fullname', 'whatsapp', 'address', 
        'pickup_time', 'notes', 'resi_code', 'status', 'payment_method', 
        'weight', 'total_price', 'payment_proof', 'laundry_photo'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}