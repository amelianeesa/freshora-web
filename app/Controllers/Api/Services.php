<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SettingModel;

class Services extends ResourceController {
    public function index() {
        $model = new SettingModel();
        $settings = $model->first(); // Mengambil baris pertama tabel settings

        // Mapping manual agar formatnya mudah dibaca oleh Flutter sebagai daftar list
        $data = [
            ['name' => 'Daily Kiloan', 'price' => $settings['price_daily'], 'desc' => $settings['desc_daily'] ?? 'Cuci bersih reguler harian'],
            ['name' => 'Express Kiloan', 'price' => $settings['price_express'], 'desc' => $settings['desc_express'] ?? 'Cuci kilat beres cepat'],
            ['name' => 'Cuci Kering', 'price' => $settings['price_dry'], 'desc' => $settings['desc_dry'] ?? 'Cuci bersih tanpa setrika'],
            ['name' => 'Setrika Saja', 'price' => $settings['price_iron'], 'desc' => $settings['desc_iron'] ?? 'Setrika rapi licin'],
            ['name' => 'Cuci & Setrika', 'price' => $settings['price_complete'], 'desc' => $settings['desc_complete'] ?? 'Paket komplit bersih wangi'],
        ];

        return $this->respond(['status' => true, 'data' => $data], 200);
    }
}