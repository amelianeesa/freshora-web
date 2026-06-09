<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\OrderModel;

class Orders extends ResourceController {
    // 1. Ambil Riwayat Pesanan berdasarkan user_id (Untuk halaman History & Dashboard)
    public function index() {
        $model = new OrderModel();
        $userId = $this->request->getGet('user_id');

        if (!$userId) {
            return $this->fail('Parameter user_id dibutuhkan', 400);
        }

        $orders = $model->where('user_id', $userId)->orderBy('id', 'DESC')->findAll();
        return $this->respond(['status' => true, 'data' => $orders], 200);
    }

    // 2. Simpan Transaksi Booking Baru dari Flutter
    public function create() {
        $model = new OrderModel();
        
        $data = [
            'user_id'        => $this->request->getVar('user_id'),
            'service_name'   => $this->request->getVar('service_name'),
            'fullname'       => $this->request->getVar('fullname'),
            'whatsapp'       => $this->request->getVar('whatsapp'),
            'address'        => $this->request->getVar('address'),
            'pickup_time'    => $this->request->getVar('pickup_time'),
            'notes'          => $this->request->getVar('notes'),
            'resi_code'      => 'TRX-' . strtoupper(substr(md5(uniqid()), 0, 5)), // Generate Resi Otomatis
            'status'         => 'Pending',
            'payment_method' => $this->request->getVar('payment_method'),
            'total_price'    => $this->request->getVar('total_price') ?? 0,
        ];

        if ($model->insert($data)) {
            return $this->respondCreated(['status' => true, 'message' => 'Booking berhasil dibuat!'], 201);
        }
        return $this->fail($model->errors());
    }
}