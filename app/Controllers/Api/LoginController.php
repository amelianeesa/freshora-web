<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use App\Models\MUserToken;

class LoginController extends RestfulController
{
    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if (!$username || !$password) {
            return $this->responseHasil(400, false, 'Username dan password harus diisi');
        }

        $model = new UserModel();
        $user  = $model->where('username', $username)->first();

        if (!$user) {
            return $this->responseHasil(400, false, 'Username tidak ditemukan');
        }

        if (!password_verify($password, $user['password'])) {
            return $this->responseHasil(400, false, 'Password tidak valid');
        }

        $tokenModel = new MUserToken();
        $auth_key   = $this->randomString();
        $tokenModel->save([
            'user_id'  => $user['id'],
            'auth_key' => $auth_key,
        ]);

        return $this->responseHasil(200, true, [
            'token' => $auth_key,
            'user'  => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'role'     => $user['role'],
                'phone'    => $user['phone'],
                'address'  => $user['address'],
            ],
        ]);
    }

    private function randomString($length = 100)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $len   = strlen($chars);
        $str   = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $len - 1)];
        }
        return $str;
    }
}