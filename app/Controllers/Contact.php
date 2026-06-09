<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Contact extends Controller
{
    
    public function index() {
        $data = [
            'page_title' => 'Hubungi Kami - FRESHORA'
        ];

        echo view('layout/header', $data);
        echo view('contact_us', $data);
        echo view('layout/footer', $data);
    }
}