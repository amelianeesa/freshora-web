<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Admin extends BaseController
{
    
    public function dashboard() {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }
        $orderModel = new OrderModel();
        $data = [
            'count_pending' => $orderModel->where('status', 'Pending')->countAllResults(),
            'count_proses'  => $orderModel->where('status', 'Proses')->countAllResults(),
            'count_selesai' => $orderModel->where('status', 'Selesai')->countAllResults(),
            'income'        => $orderModel->where('status', 'Selesai')->selectSum('total_price')->get()->getRow()->total_price,
            'latest_orders' => $orderModel->orderBy('created_at', 'DESC')->findAll(5)
        ];
        return view('admin/dashboard', $data);
    }

    public function orders() {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }
        $orderModel = new OrderModel();
        $data['orders'] = $orderModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/orders', $data);
    }

    public function order_detail($id) {
    if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $orderModel = new \App\Models\OrderModel();
    $settingsModel = new \App\Models\SettingsModel(); 

    $data['order'] = $orderModel->find($id);
    
    $data['settings'] = $settingsModel->find(1); 

    if (!$data['order']) {
        return redirect()->to('/admin/orders');
    }

    return view('admin/order_detail', $data);
    }

    public function order_update() {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $orderModel = new \App\Models\OrderModel();
        $id = $this->request->getPost('id');

        $data = [
            'weight'      => $this->request->getPost('weight'),
            'total_price' => $this->request->getPost('total_price'),
            'status'      => $this->request->getPost('status'),
        ];

        $foto = $this->request->getFile('laundry_photo');

        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            
            $foto->move('uploads/laundry', $namaFoto);

            $data['laundry_photo'] = $namaFoto;
        }

        $orderModel->update($id, $data);

        return redirect()->to('/admin/orders')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function messages() {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }
        $messageModel = new \App\Models\MessageModel();
        $data['messages'] = $messageModel->orderBy('created_at', 'DESC')->findAll();
        return view('messages', $data);
    }
    public function settings()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $settingsModel = new \App\Models\SettingsModel();
        
        // Ambil data settings (ID 1)
        $data['settings'] = $settingsModel->find(1);

        return view('admin/settings', $data);
    }

    public function settings_update()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $settingsModel = new \App\Models\SettingsModel();
        $data = [
            'price_daily'    => $this->request->getPost('price_daily'),
            'price_express'  => $this->request->getPost('price_express'),
            'price_dry'      => $this->request->getPost('price_dry'),
            'price_iron'     => $this->request->getPost('price_iron'),
            'price_complete' => $this->request->getPost('price_complete'), 
            'bank_name'      => $this->request->getPost('bank_name'),
            'bank_number'    => $this->request->getPost('bank_number'),
            'bank_holder'    => $this->request->getPost('bank_holder'),
            'whatsapp_admin' => $this->request->getPost('whatsapp_admin'),
        ];

        $fileQris = $this->request->getFile('qris_image');
        if ($fileQris && $fileQris->isValid() && !$fileQris->hasMoved()) {
            $namaQris = $fileQris->getRandomName();
            $fileQris->move('assets/img', $namaQris);
            $data['qris_image'] = $namaQris;
        }

        $settingsModel->update(1, $data);

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan Toko berhasil diperbarui!');
    }

    public function password_update()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $adminId = session()->get('id');
        $admin = $userModel->find($adminId);

        $oldPass = $this->request->getPost('old_password');
        $newPass = $this->request->getPost('new_password');
        $confPass = $this->request->getPost('confirm_password');

        if (!password_verify($oldPass, $admin['password'])) {
            return redirect()->back()->with('error', 'Password lama salah!');
        }

        if ($newPass != $confPass) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok!');
        }

        $userModel->update($adminId, [
            'password' => password_hash($newPass, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/admin/settings')->with('success', 'Password berhasil diubah!');
    }

    
}