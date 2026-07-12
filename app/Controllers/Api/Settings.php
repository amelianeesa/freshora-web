<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SettingsModel;

class Settings extends ResourceController {
    
    // GET /api/settings
    public function index() {
        $model = new SettingsModel();
        // ID setting selalu 1
        $settings = $model->find(1);
        
        if (!$settings) {
            return $this->failNotFound('Settings tidak ditemukan');
        }

        // Jika QRIS image ada, berikan URL lengkapnya agar Flutter gampang nampilin
        if (!empty($settings['qris_image'])) {
            $settings['qris_url'] = base_url('assets/img/' . $settings['qris_image']);
        }

        return $this->respond(['status' => true, 'data' => $settings], 200);
    }
}
