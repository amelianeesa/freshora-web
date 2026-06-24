<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\OrderModel;

class Orders extends ResourceController {

    // GET /api/orders?user_id=X
    public function index() {
        $model = new OrderModel();
        $userId = $this->request->getGet('user_id');

        if (!$userId) {
            return $this->fail('Parameter user_id dibutuhkan', 400);
        }

        $orders = $model->where('user_id', $userId)->orderBy('id', 'DESC')->findAll();
        return $this->respond(['status' => true, 'data' => $orders], 200);
    }

    // POST /api/orders
    public function create() {
        $model = new OrderModel();

        $resi = 'TRX-' . strtoupper(substr(md5(uniqid()), 0, 5));

        $data = [
            'user_id'        => $this->request->getVar('user_id'),
            'service_name'   => $this->request->getVar('service_name'),
            'fullname'       => $this->request->getVar('fullname'),
            'whatsapp'       => $this->request->getVar('whatsapp'),
            'address'        => $this->request->getVar('address'),
            'pickup_time'    => $this->request->getVar('pickup_time'),
            'notes'          => $this->request->getVar('notes'),
            'resi_code'      => $resi,
            'status'         => 'Pending',
            'payment_method' => $this->request->getVar('payment_method'),
            'total_price'    => $this->request->getVar('total_price') ?? 0,
        ];

        if ($model->insert($data)) {
            return $this->respondCreated([
                'status'  => true,
                'message' => 'Booking berhasil dibuat!',
                'resi'    => $resi,
            ]);
        }
        return $this->fail($model->errors());
    }

    // GET /api/orders/{resi}
    public function show($resi = null) {
        $model = new OrderModel();
        $order = $model->where('resi_code', strtoupper($resi))->first();

        if (!$order) {
            return $this->failNotFound('Resi tidak ditemukan');
        }

        return $this->respond(['status' => true, 'data' => $order]);
    }
}