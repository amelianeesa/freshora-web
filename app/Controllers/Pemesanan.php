<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel; 

class Pemesanan extends BaseController
{
    public function index() {
        $layanan = $this->request->getGet('layanan');
        $data = [
            'layanan_terpilih' => $layanan ? $layanan : '' 
        ];
        return view('form_pemesanan', $data);
    }

    public function kirim() {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $validation = \Config\Services::validation();
        $rules = [
            'nama'            => 'required',
            'whatsapp'        => 'required|numeric',
            'alamat'          => 'required',
            'jam_pengambilan' => 'required',
            'payment_method'  => 'required' 
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $resi = 'TRX-' . strtoupper(substr(md5(time() . rand()), 0, 5));
        $data = [
            'user_id' => session()->get('user_id'),
            'fullname'    => $this->request->getPost('nama'),
            'service_name' => $this->request->getPost('layanan'),
            'whatsapp'    => $this->request->getPost('whatsapp'),
            'address'     => $this->request->getPost('alamat'),
            'pickup_time' => $this->request->getPost('jam_pengambilan'),
            'notes'       => $this->request->getPost('catatan_tambahan'),
            
            'payment_method' => $this->request->getPost('payment_method'), 
           
            'resi_code'   => $resi,
            'status'      => 'Pending', 
            'weight'      => 0,         
            'total_price' => 0          
        ];
        $orderModel = new OrderModel();
        $orderModel->save($data);
        return redirect()->to("/pemesanan/sukses/$resi");
    }

    public function sukses($resi)
    {
        $data['resi'] = $resi;
        return view('success', $data);
    }
}