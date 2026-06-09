<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Transaksi extends BaseController
{
    public function upload_bukti()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrderModel();
        $orderId    = $this->request->getPost('order_id');
        $fileBukti  = $this->request->getFile('bukti_bayar');

        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
            
            $namaFile = $fileBukti->getRandomName();
            
            $fileBukti->move('uploads/payments', $namaFile);

            $orderModel->update($orderId, [
                'payment_proof' => $namaFile
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim! Mohon tunggu verifikasi admin.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupload gambar. Pastikan formatnya JPG/PNG.');
        }
    }
}