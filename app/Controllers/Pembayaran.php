<?php

namespace App\Controllers;

class Pembayaran extends BaseController
{
    public function index() {
        return view('metode_pembayaran'); 
    }
}