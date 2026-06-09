<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('user_id'));

        return view('dashboard', $data);
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('user_id'));

        return view('edit_profile', $data);
    }

    public function update()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $id = session()->get('user_id');

        $fileGambar = $this->request->getFile('profile_image');
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getPost('gambarLama');
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/profile', $namaGambar);
        }

        $data = [
            'id' => $id,
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'), 
            'phone'    => $this->request->getPost('phone'),
            'address'  => $this->request->getPost('address'),
            'profile_image' => $namaGambar
        ];

        $userModel->save($data);
        session()->set('username', $data['username']);
        return redirect()->to('/account')->with('success', 'Profil berhasil diperbarui!');
    }
}