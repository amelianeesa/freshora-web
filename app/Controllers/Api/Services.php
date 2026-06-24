<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Services extends ResourceController {
    public function index() {
        $db = \Config\Database::connect();
        $settings = $db->table('settings')->get()->getFirstRow('array');

        if (!$settings) {
            return $this->respond(['status' => false, 'message' => 'Data settings kosong'], 404);
        }

        $data = [
            ['name' => 'Daily Kiloan',   'price' => $settings['price_daily'],    'desc' => 'Cuci bersih reguler harian'],
            ['name' => 'Express Kiloan', 'price' => $settings['price_express'],  'desc' => 'Cuci kilat beres cepat'],
            ['name' => 'Cuci Kering',    'price' => $settings['price_dry'],      'desc' => 'Cuci bersih tanpa setrika'],
            ['name' => 'Setrika Saja',   'price' => $settings['price_iron'],     'desc' => 'Setrika rapi licin'],
            ['name' => 'Cuci & Setrika', 'price' => $settings['price_complete'], 'desc' => 'Paket komplit bersih wangi'],
        ];

        return $this->respond(['status' => true, 'data' => $data], 200);
    }
}