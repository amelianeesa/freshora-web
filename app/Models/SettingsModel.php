<?php
namespace App\Models;
use CodeIgniter\Model;

class SettingModel extends Model {
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'price_daily', 'price_express', 'price_dry', 'price_iron', 'price_complete',
        'desc_daily', 'desc_express', 'desc_dry', 'desc_iron', 'desc_complete'
    ];
}