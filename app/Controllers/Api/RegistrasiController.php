<?php

namespace App\Controllers\Api;

use App\Models\UserModel;

class RegistrasiController extends RestfulController
{
    public function registrasi()
    {
        $username = $this->request->getVar('username');
        $fullname = $this->request->getVar('fullname');
        $password = $this->request->getVar('password');

        if (!$username || !$fullname || !$password) {
            return $this->responseHasil(400, false, 'Semua field harus diisi');
        }

        $model = new UserModel();
        $cek   = $model->where('username', $username)->first();
        if ($cek) {
            return $this->responseHasil(400, false, 'Username sudah digunakan');
        }

        $model->save([
            'username'      => $username,
            'fullname'      => $fullname,
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'role'          => 'user',
            'profile_image' => 'default.png',
        ]);

        return $this->responseHasil(200, true, 'Registrasi Berhasil');
    }
}