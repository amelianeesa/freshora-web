<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'price_daily', 'price_express', 'price_dry', 'price_iron', 'price_complete',
        'bank_name', 'bank_number', 'bank_holder', 'whatsapp_admin', 'qris_image'
    ];
}