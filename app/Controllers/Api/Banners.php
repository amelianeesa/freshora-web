<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BannerModel;

class Banners extends ResourceController {

    // GET /api/banners
    public function index() {
        $model = new BannerModel();
        $banners = $model->orderBy('created_at', 'DESC')->findAll();
        return $this->respond(['status' => true, 'data' => $banners], 200);
    }

    // GET /api/banner_image/{filename}
    public function image($filename)
    {
        $path = FCPATH . 'uploads/banners/' . $filename;
        if (file_exists($path)) {
            $mime = mime_content_type($path);
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, OPTIONS');
            header('Content-Type: ' . $mime);
            readfile($path);
            exit;
        }
        return $this->failNotFound('Image not found');
    }
}
