<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login() {
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') == 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/');
        }
        return view('auth/login');
    }

    public function register() {
        return view('auth/register');
    }

    public function attemptRegister() {
        $rules = [
            'username'      => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'password'      => 'required|min_length[6]',
            'pass_confirm'  => 'matches[password]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user'
        ];
        $userModel->save($data);
        session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->to('/login');
    }

    public function attemptLogin() {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true
                ];
                session()->set($sessionData);
                if ($user['role'] == 'admin') {
                    return redirect()->to('/admin/dashboard'); 
                } else {
                    return redirect()->to('/');
                }
            }
        }
        session()->setFlashdata('error', 'Username atau Password salah! Silakan coba lagi.');
        return redirect()->back()->withInput();
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}