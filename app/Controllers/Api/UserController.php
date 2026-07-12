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
        if (!empty($user['profile_image'])) {
            $user['profile_image_url'] = base_url('api/image/' . $user['profile_image']);
        }
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

        // Handle File Upload untuk Profile Image
        $fileImage = $this->request->getFile('profile_image');
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $newName = $fileImage->getRandomName();
            $fileImage->move('assets/img/profile', $newName);
            $data['profile_image'] = $newName;
        }

        if (empty($data)) {
            return $this->responseHasil(400, false, 'Tidak ada data yang diupdate');
        }

        $userModel = new UserModel();
        $userModel->update($user['id'], $data);

        $updatedUser = $userModel->find($user['id']);
        unset($updatedUser['password']);
        
        if (!empty($updatedUser['profile_image'])) {
            $updatedUser['profile_image_url'] = base_url('api/image/' . $updatedUser['profile_image']);
        }

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

    // GET /api/image/{filename}
    public function image($filename)
    {
        $path = FCPATH . 'assets/img/profile/' . $filename;
        if (file_exists($path)) {
            $mime = mime_content_type($path);
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, OPTIONS');
            header('Content-Type: ' . $mime);
            readfile($path);
            exit;
        }
        return $this->responseHasil(404, false, 'Image not found');
    }
}