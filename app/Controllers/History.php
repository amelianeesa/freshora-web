<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class History extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        $orderModel = new OrderModel();

        $data['orders'] = $orderModel->where('user_id', $userId)
                                     ->orderBy('created_at', 'DESC')
                                     ->findAll();

        return view('history', $data);
    }
}