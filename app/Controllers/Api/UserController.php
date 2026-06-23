<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use App\Models\MUserToken;

class UserController extends RestfulController
{
    private function getUserFromToken()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) return null;

        $token      = str_replace('Bearer ', '', $authHeader);
        $tokenModel = new MUserToken();
        $tokenData  = $tokenModel->where('auth_key', $token)->first();
        if (!$tokenData) return null;

        $userModel = new UserModel();
        return $userModel->find($tokenData['user_id']);
    }

    // GET /api/profile
    public function profile()
    {
        $user = $this->getUserFromToken();
        if (!$user) {
            return $this->responseHasil(401, false, 'Token tidak valid');
        }

        unset($user['password']);
        return $this->responseHasil(200, true, $user);
    }

    // POST /api/profile/update
    public function updateProfile()
    {
        $user = $this->getUserFromToken();
        if (!$user) {
            return $this->responseHasil(401, false, 'Token tidak valid');
        }

        $data = [];
        if ($this->request->getVar('fullname'))
            $data['fullname'] = $this->request->getVar('fullname');
        if ($this->request->getVar('phone'))
            $data['phone']    = $this->request->getVar('phone');
        if ($this->request->getVar('address'))
            $data['address']  = $this->request->getVar('address');

        if (empty($data)) {
            return $this->responseHasil(400, false, 'Tidak ada data yang diupdate');
        }

        $userModel = new UserModel();
        $userModel->update($user['id'], $data);

        $updatedUser = $userModel->find($user['id']);
        unset($updatedUser['password']);

        return $this->responseHasil(200, true, $updatedUser);
    }

    // POST /api/logout
    public function logout()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return $this->responseHasil(400, false, 'Token tidak ditemukan');
        }

        $token      = str_replace('Bearer ', '', $authHeader);
        $tokenModel = new MUserToken();
        $tokenModel->where('auth_key', $token)->delete();

        return $this->responseHasil(200, true, 'Logout berhasil');
    }
}