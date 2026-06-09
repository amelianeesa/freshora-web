<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Tracking extends BaseController
{
    public function index()
    {
        $resi = $this->request->getGet('resi');

        if ($resi) {
            return $this->prosesPencarian($resi);
        }

        return view('tracking');
    }

    public function cari()
    {
        $resi = $this->request->getPost('resi');
        
        return $this->prosesPencarian($resi);
    }

    private function prosesPencarian($resi)
    {
        $orderModel = new OrderModel();
        $resiBersih = strtoupper(trim($resi)); 
        $order = $orderModel->where('resi_code', $resiBersih)->first();

        if ($order) {
            $data = [
                'order' => $order,
                'resi'  => $resiBersih
            ];
            return view('tracking', $data);
        } else {
            session()->setFlashdata('error', "Kode Resi '$resiBersih' tidak ditemukan! Pastikan kode benar.");
            return redirect()->to('/tracking');
        }
    }
}