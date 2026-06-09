<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Order extends BaseController
{
    public function index() {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        return view('order/form'); 
    }

    public function submit() {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrderModel();
        $resi = 'TRX-' . strtoupper(substr(md5(time()), 0, 5)); //ini kalo no resinya diganti, biar ga bosen trx trs

        $data = [
            'user_id'     => session()->get('user_id'),
            'fullname'    => $this->request->getPost('nama'),       
            'whatsapp'    => $this->request->getPost('whatsapp'),
            'address'     => $this->request->getPost('alamat'),
            'pickup_time' => $this->request->getPost('jam_pengambilan'),
            'notes'       => $this->request->getPost('catatan'),
            'resi_code'   => $resi,
            'status'      => 'Pending' 
        ];

        $orderModel->save($data);
        return redirect()->to("/order/success/$resi");
    }

    public function success($resi) {
        $data['resi'] = $resi;
        return view('order/success', $data);
    }
}