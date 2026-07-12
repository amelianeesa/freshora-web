<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/pesan', 'Pemesanan::index');
$routes->post('/pesan/kirim', 'Pemesanan::kirim');
$routes->get('/service', 'Service::index');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin'); 
$routes->get('logout', 'Auth::logout');
$routes->get('profile', 'Profile::index');
$routes->post('profile/update', 'Profile::update');
$routes->get('contact', 'Home::contact');         
$routes->post('contact/send', 'Home::sendContact'); 
$routes->get('order', 'Order::index');       
$routes->post('order/submit', 'Order::submit'); 
$routes->get('order/success/(:segment)', 'Order::success/$1'); 
$routes->get('pemesanan', 'Pemesanan::index');
$routes->post('pemesanan/kirim', 'Pemesanan::kirim');
$routes->get('pemesanan/sukses/(:segment)', 'Pemesanan::sukses/$1');
$routes->get('pemesanan', 'Pemesanan::index');
$routes->post('pemesanan/kirim', 'Pemesanan::kirim');
$routes->get('pemesanan/sukses/(:segment)', 'Pemesanan::sukses/$1');
$routes->get('tracking', 'Tracking::index');
$routes->post('tracking/cari', 'Tracking::cari');
$routes->get('account', 'Profile::dashboard');
$routes->get('account', 'Profile::dashboard');      
$routes->get('profile', 'Profile::index');          
$routes->post('profile/update', 'Profile::update');
$routes->get('history', 'History::index');
$routes->post('transaksi/upload_bukti', 'Transaksi::upload_bukti');
$routes->get('tracking', 'Tracking::index');

$routes->match(['get', 'post'], 'tracking/cari', 'Tracking::cari');

$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('orders', 'Admin::orders');
    $routes->get('order/detail/(:num)', 'Admin::order_detail/$1');
    $routes->post('order/update', 'Admin::order_update');
    $routes->get('messages', 'Admin::messages'); 
    $routes->get('settings', 'Admin::settings');
    $routes->post('settings/update', 'Admin::settings_update');
    $routes->post('password/update', 'Admin::password_update');
    $routes->post('banner/add', 'Admin::banner_add');
    $routes->get('banner/delete/(:num)', 'Admin::banner_delete/$1');
});

$routes->group('api', function($routes) {
    $routes->get('services', 'Api\Services::index');
    $routes->resource('orders', ['controller' => 'Api\Orders']);
    $routes->get('settings', 'Api\Settings::index');
    $routes->get('laundry_image/(:segment)', 'Api\Orders::image/$1');
    $routes->get('banners', 'Api\Banners::index');
    $routes->get('banner_image/(:segment)', 'Api\Banners::image/$1');
});

$routes->options('api/registrasi',     'App\Controllers\Api\RegistrasiController::registrasi');
$routes->options('api/login',          'App\Controllers\Api\LoginController::login');
$routes->options('api/logout',         'App\Controllers\Api\LogoutController::logout');
$routes->options('api/profile',        'App\Controllers\Api\UserController::profile');
$routes->options('api/profile/update', 'App\Controllers\Api\UserController::updateProfile');
$routes->options('api/orders',         'Api\Orders::index');
$routes->options('api/banners',        'Api\Banners::index');
// =============================================
// API Routes - Freshora Mobile
// =============================================
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->post('registrasi',      'RegistrasiController::registrasi');
    $routes->post('login',           'LoginController::login');
    $routes->post('logout',          'UserController::logout');
    $routes->get('profile',          'UserController::profile');
    $routes->post('profile/update',  'UserController::updateProfile');
    $routes->get('image/(:segment)', 'UserController::image/$1');
});