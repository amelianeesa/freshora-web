# 📋 Dokumentasi API — Freshora Laundry

> **Framework:** CodeIgniter 4  
> **Base URL:** `http://localhost:8080`  
> **Database:** MySQL (`laundry`)  
> **Format Response API:** JSON  
> **Versi:** 1.0

---

## Daftar Isi

1. [Gambaran Umum](#gambaran-umum)
2. [Autentikasi](#autentikasi)
3. [Format Response](#format-response)
4. [API Endpoints (Mobile)](#api-endpoints-mobile)
   - [Registrasi](#1-registrasi)
   - [Login](#2-login)
   - [Logout](#3-logout)
   - [Get Profile](#4-get-profile)
   - [Update Profile](#5-update-profile)
   - [Get Services](#6-get-services-layanan)
   - [Get Orders (by User)](#7-get-orders-by-user)
   - [Create Order](#8-create-order)
   - [Show Order (by Resi)](#9-show-order-by-resi)
5. [Web Routes (Frontend)](#web-routes-frontend)
6. [Admin Routes](#admin-routes)
7. [Database Schema](#database-schema)
8. [Konfigurasi CORS](#konfigurasi-cors)

---

## Gambaran Umum

Freshora Laundry adalah aplikasi manajemen laundry yang terdiri dari:

- **REST API** (`/api/*`) — Digunakan oleh aplikasi mobile (Freshora Mobile) dengan autentikasi Bearer Token.
- **Web Routes** — Halaman web frontend untuk pengguna (order, tracking, profil, dll.) dengan autentikasi session-based.
- **Admin Panel** (`/admin/*`) — Dashboard admin untuk mengelola pesanan, pesan, dan pengaturan toko.

---

## Autentikasi

### API (Mobile) — Bearer Token

Semua endpoint yang memerlukan autentikasi menggunakan **Bearer Token** via header `Authorization`.

```
Authorization: Bearer <token>
```

Token didapatkan setelah berhasil login melalui endpoint `POST /api/login`. Token disimpan di tabel `user_token` dan dihapus saat logout.

### Web (Browser) — Session

Halaman web menggunakan autentikasi berbasis **session PHP**. Data session meliputi:

| Key          | Tipe     | Deskripsi                  |
|--------------|----------|----------------------------|
| `user_id`    | `int`    | ID user yang login         |
| `username`   | `string` | Username user              |
| `role`       | `string` | Role user (`user`/`admin`) |
| `isLoggedIn` | `bool`   | Status login               |

---

## Format Response

### API yang menggunakan `RestfulController` (Login, Registrasi, User)

```json
{
  "code": 200,
  "status": true,
  "data": { ... }
}
```

| Field    | Tipe            | Deskripsi                                     |
|----------|-----------------|-----------------------------------------------|
| `code`   | `int`           | HTTP status code                              |
| `status` | `bool`          | `true` jika berhasil, `false` jika gagal      |
| `data`   | `mixed`         | Data response (object, array, atau string pesan) |

### API yang menggunakan `ResourceController` (Orders, Services)

```json
{
  "status": true,
  "data": { ... }
}
```

Atau jika error:

```json
{
  "status": 400,
  "error": 400,
  "messages": {
    "error": "Pesan error"
  }
}
```

---

## API Endpoints (Mobile)

> **Namespace:** `App\Controllers\Api`  
> **Prefix:** `/api`

---

### 1. Registrasi

Mendaftarkan user baru.

| Properti     | Nilai                              |
|--------------|------------------------------------|
| **URL**      | `/api/registrasi`                  |
| **Method**   | `POST`                             |
| **Auth**     | ❌ Tidak perlu                      |
| **Controller** | `RegistrasiController::registrasi` |

#### Request Body

| Parameter  | Tipe     | Wajib | Deskripsi              |
|------------|----------|-------|------------------------|
| `username` | `string` | ✅    | Username unik          |
| `fullname` | `string` | ✅    | Nama lengkap           |
| `password` | `string` | ✅    | Password (plain text)  |

#### Response Sukses (`200`)

```json
{
  "code": 200,
  "status": true,
  "data": "Registrasi Berhasil"
}
```

#### Response Error (`400`)

```json
{
  "code": 400,
  "status": false,
  "data": "Semua field harus diisi"
}
```

```json
{
  "code": 400,
  "status": false,
  "data": "Username sudah digunakan"
}
```

#### Catatan

- Password akan di-hash menggunakan `PASSWORD_DEFAULT` (bcrypt).
- User baru otomatis memiliki `role = 'user'` dan `profile_image = 'default.png'`.

---

### 2. Login

Autentikasi user dan mendapatkan token.

| Properti     | Nilai                        |
|--------------|------------------------------|
| **URL**      | `/api/login`                 |
| **Method**   | `POST`                       |
| **Auth**     | ❌ Tidak perlu                |
| **Controller** | `LoginController::login`   |

#### Request Body

| Parameter  | Tipe     | Wajib | Deskripsi      |
|------------|----------|-------|----------------|
| `username` | `string` | ✅    | Username       |
| `password` | `string` | ✅    | Password       |

#### Response Sukses (`200`)

```json
{
  "code": 200,
  "status": true,
  "data": {
    "token": "aB3xYz...random100chars",
    "user": {
      "id": 1,
      "username": "johndoe",
      "fullname": "John Doe",
      "role": "user",
      "phone": "081234567890",
      "address": "Jl. Contoh No. 1"
    }
  }
}
```

#### Response Error (`400`)

```json
{
  "code": 400,
  "status": false,
  "data": "Username dan password harus diisi"
}
```

```json
{
  "code": 400,
  "status": false,
  "data": "Username tidak ditemukan"
}
```

```json
{
  "code": 400,
  "status": false,
  "data": "Password tidak valid"
}
```

#### Catatan

- Token berupa string random sepanjang 100 karakter.
- Token disimpan di tabel `user_token` yang berasosiasi dengan `user_id`.

---

### 3. Logout

Menghapus token autentikasi user.

| Properti     | Nilai                        |
|--------------|------------------------------|
| **URL**      | `/api/logout`                |
| **Method**   | `POST`                       |
| **Auth**     | ✅ Bearer Token               |
| **Controller** | `UserController::logout`   |

#### Request Headers

```
Authorization: Bearer <token>
```

#### Response Sukses (`200`)

```json
{
  "code": 200,
  "status": true,
  "data": "Logout berhasil"
}
```

#### Response Error (`400`)

```json
{
  "code": 400,
  "status": false,
  "data": "Token tidak ditemukan"
}
```

---

### 4. Get Profile

Mengambil data profil user yang sedang login.

| Properti     | Nilai                         |
|--------------|-------------------------------|
| **URL**      | `/api/profile`                |
| **Method**   | `GET`                         |
| **Auth**     | ✅ Bearer Token                |
| **Controller** | `UserController::profile`   |

#### Request Headers

```
Authorization: Bearer <token>
```

#### Response Sukses (`200`)

```json
{
  "code": 200,
  "status": true,
  "data": {
    "id": 1,
    "username": "johndoe",
    "fullname": "John Doe",
    "phone": "081234567890",
    "address": "Jl. Contoh No. 1",
    "profile_image": "default.png",
    "role": "user",
    "created_at": "2025-01-01 00:00:00"
  }
}
```

> **Catatan:** Field `password` tidak disertakan dalam response.

#### Response Error (`401`)

```json
{
  "code": 401,
  "status": false,
  "data": "Token tidak valid"
}
```

---

### 5. Update Profile

Memperbarui data profil user.

| Properti     | Nilai                                |
|--------------|--------------------------------------|
| **URL**      | `/api/profile/update`                |
| **Method**   | `POST`                               |
| **Auth**     | ✅ Bearer Token                       |
| **Controller** | `UserController::updateProfile`    |

#### Request Headers

```
Authorization: Bearer <token>
```

#### Request Body

| Parameter  | Tipe     | Wajib | Deskripsi           |
|------------|----------|-------|---------------------|
| `fullname` | `string` | ❌    | Nama lengkap baru   |
| `phone`    | `string` | ❌    | Nomor telepon baru  |
| `address`  | `string` | ❌    | Alamat baru         |

> Minimal satu field harus diisi.

#### Response Sukses (`200`)

```json
{
  "code": 200,
  "status": true,
  "data": {
    "id": 1,
    "username": "johndoe",
    "fullname": "John Doe Updated",
    "phone": "081234567890",
    "address": "Jl. Baru No. 2",
    "profile_image": "default.png",
    "role": "user",
    "created_at": "2025-01-01 00:00:00"
  }
}
```

#### Response Error (`400`)

```json
{
  "code": 400,
  "status": false,
  "data": "Tidak ada data yang diupdate"
}
```

#### Response Error (`401`)

```json
{
  "code": 401,
  "status": false,
  "data": "Token tidak valid"
}
```

---

### 6. Get Services (Layanan)

Mengambil daftar layanan laundry beserta harga.

| Properti     | Nilai                       |
|--------------|-----------------------------|
| **URL**      | `/api/services`             |
| **Method**   | `GET`                       |
| **Auth**     | ❌ Tidak perlu               |
| **Controller** | `Api\Services::index`     |

#### Response Sukses (`200`)

```json
{
  "status": true,
  "data": [
    {
      "name": "Daily Kiloan",
      "price": "7000",
      "desc": "Cuci bersih reguler harian"
    },
    {
      "name": "Express Kiloan",
      "price": "12000",
      "desc": "Cuci kilat beres cepat"
    },
    {
      "name": "Cuci Kering",
      "price": "5000",
      "desc": "Cuci bersih tanpa setrika"
    },
    {
      "name": "Setrika Saja",
      "price": "4000",
      "desc": "Setrika rapi licin"
    },
    {
      "name": "Cuci & Setrika",
      "price": "10000",
      "desc": "Paket komplit bersih wangi"
    }
  ]
}
```

#### Response Error (`404`)

```json
{
  "status": false,
  "message": "Data settings kosong"
}
```

#### Catatan

- Harga diambil dari tabel `settings` (row pertama).
- Data layanan bersifat hardcoded (5 layanan tetap), hanya harganya yang dinamis dari database.

---

### 7. Get Orders (by User)

Mengambil daftar pesanan berdasarkan user ID.

| Properti     | Nilai                      |
|--------------|----------------------------|
| **URL**      | `/api/orders?user_id=X`    |
| **Method**   | `GET`                      |
| **Auth**     | ❌ Tidak perlu (tapi butuh `user_id`) |
| **Controller** | `Api\Orders::index`      |

#### Query Parameters

| Parameter | Tipe  | Wajib | Deskripsi     |
|-----------|-------|-------|---------------|
| `user_id` | `int` | ✅    | ID user       |

#### Response Sukses (`200`)

```json
{
  "status": true,
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "service_name": "Daily Kiloan",
      "fullname": "John Doe",
      "whatsapp": "081234567890",
      "address": "Jl. Contoh No. 1",
      "pickup_time": "10:00",
      "notes": "Pisahkan baju putih",
      "resi_code": "TRX-A1B2C",
      "status": "Pending",
      "payment_method": "transfer",
      "weight": null,
      "total_price": "0",
      "payment_proof": null,
      "laundry_photo": null,
      "created_at": "2025-07-10 14:30:00",
      "updated_at": "2025-07-10 14:30:00"
    }
  ]
}
```

#### Response Error (`400`)

```json
{
  "status": 400,
  "error": 400,
  "messages": {
    "error": "Parameter user_id dibutuhkan"
  }
}
```

---

### 8. Create Order

Membuat pesanan laundry baru.

| Properti     | Nilai                       |
|--------------|-----------------------------|
| **URL**      | `/api/orders`               |
| **Method**   | `POST`                      |
| **Auth**     | ❌ Tidak perlu (tapi butuh `user_id`) |
| **Controller** | `Api\Orders::create`      |

#### Request Body

| Parameter        | Tipe     | Wajib | Deskripsi                          |
|------------------|----------|-------|------------------------------------|
| `user_id`        | `int`    | ✅    | ID user yang memesan               |
| `service_name`   | `string` | ✅    | Nama layanan yang dipilih          |
| `fullname`       | `string` | ✅    | Nama lengkap pemesan               |
| `whatsapp`       | `string` | ✅    | Nomor WhatsApp pemesan             |
| `address`        | `string` | ✅    | Alamat penjemputan                 |
| `pickup_time`    | `string` | ✅    | Waktu penjemputan                  |
| `notes`          | `string` | ❌    | Catatan tambahan                   |
| `payment_method` | `string` | ❌    | Metode pembayaran                  |
| `total_price`    | `int`    | ❌    | Total harga (default: `0`)         |

#### Response Sukses (`201`)

```json
{
  "status": true,
  "message": "Booking berhasil dibuat!",
  "resi": "TRX-A1B2C"
}
```

#### Response Error

```json
{
  "status": 400,
  "error": 400,
  "messages": {
    "error": "..."
  }
}
```

#### Catatan

- Kode resi di-generate otomatis dengan format `TRX-XXXXX` (5 karakter hex uppercase dari MD5 `uniqid()`).
- Status pesanan baru otomatis `Pending`.

---

### 9. Show Order (by Resi)

Mengambil detail pesanan berdasarkan kode resi.

| Properti     | Nilai                            |
|--------------|----------------------------------|
| **URL**      | `/api/orders/{resi_code}`        |
| **Method**   | `GET`                            |
| **Auth**     | ❌ Tidak perlu                    |
| **Controller** | `Api\Orders::show`             |

#### URL Parameters

| Parameter   | Tipe     | Wajib | Deskripsi                  |
|-------------|----------|-------|----------------------------|
| `resi_code` | `string` | ✅    | Kode resi (case-insensitive, auto uppercase) |

#### Response Sukses (`200`)

```json
{
  "status": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "service_name": "Daily Kiloan",
    "fullname": "John Doe",
    "whatsapp": "081234567890",
    "address": "Jl. Contoh No. 1",
    "pickup_time": "10:00",
    "notes": "Pisahkan baju putih",
    "resi_code": "TRX-A1B2C",
    "status": "Proses",
    "payment_method": "transfer",
    "weight": "3.5",
    "total_price": "24500",
    "payment_proof": "random_filename.jpg",
    "laundry_photo": "random_filename.jpg",
    "created_at": "2025-07-10 14:30:00",
    "updated_at": "2025-07-11 10:00:00"
  }
}
```

#### Response Error (`404`)

```json
{
  "status": 404,
  "error": 404,
  "messages": {
    "error": "Resi tidak ditemukan"
  }
}
```

---

## Web Routes (Frontend)

> Route berikut digunakan oleh halaman web (browser). Menggunakan autentikasi **session-based**.

### Halaman Publik (Tanpa Login)

| Method        | URL                               | Controller                 | Deskripsi                            |
|---------------|-----------------------------------|----------------------------|--------------------------------------|
| `GET`         | `/`                               | `Home::index`              | Halaman utama                        |
| `GET`         | `/login`                          | `Auth::login`              | Halaman login                        |
| `GET`         | `/register`                       | `Auth::register`           | Halaman registrasi                   |
| `POST`        | `/auth/attemptRegister`           | `Auth::attemptRegister`    | Proses registrasi                    |
| `POST`        | `/auth/attemptLogin`              | `Auth::attemptLogin`       | Proses login                         |
| `GET`         | `/contact`                        | `Home::contact`            | Halaman kontak                       |
| `POST`        | `/contact/send`                   | `Home::sendContact`        | Kirim pesan kontak                   |
| `GET`         | `/service`                        | `Service::index`           | Halaman daftar layanan               |
| `GET`         | `/tracking`                       | `Tracking::index`          | Halaman tracking pesanan             |
| `GET/POST`    | `/tracking/cari`                  | `Tracking::cari`           | Cari pesanan berdasarkan resi        |
| `GET`         | `/pemesanan`                      | `Pemesanan::index`         | Halaman form pemesanan               |

### Halaman User (Perlu Login)

| Method | URL                              | Controller                  | Deskripsi                             |
|--------|----------------------------------|-----------------------------|---------------------------------------|
| `GET`  | `/logout`                        | `Auth::logout`              | Logout dan destroy session            |
| `GET`  | `/account`                       | `Profile::dashboard`        | Dashboard akun user                   |
| `GET`  | `/profile`                       | `Profile::index`            | Halaman edit profil                   |
| `POST` | `/profile/update`                | `Profile::update`           | Proses update profil (+ upload foto)  |
| `GET`  | `/order`                         | `Order::index`              | Form order laundry                    |
| `POST` | `/order/submit`                  | `Order::submit`             | Submit order laundry                  |
| `GET`  | `/order/success/{resi}`          | `Order::success`            | Halaman sukses order                  |
| `POST` | `/pemesanan/kirim`               | `Pemesanan::kirim`          | Submit pemesanan (form alternatif)    |
| `GET`  | `/pemesanan/sukses/{resi}`       | `Pemesanan::sukses`         | Halaman sukses pemesanan              |
| `GET`  | `/history`                       | `History::index`            | Riwayat pesanan user                  |
| `POST` | `/transaksi/upload_bukti`        | `Transaksi::upload_bukti`   | Upload bukti pembayaran               |

---

## Admin Routes

> Prefix: `/admin`  
> Semua route memerlukan login dengan **role = admin**.

| Method | URL                               | Controller                  | Deskripsi                              |
|--------|-----------------------------------|-----------------------------|----------------------------------------|
| `GET`  | `/admin/dashboard`                | `Admin::dashboard`          | Dashboard admin (statistik pesanan)    |
| `GET`  | `/admin/orders`                   | `Admin::orders`             | Daftar semua pesanan                   |
| `GET`  | `/admin/order/detail/{id}`        | `Admin::order_detail`       | Detail pesanan berdasarkan ID          |
| `POST` | `/admin/order/update`             | `Admin::order_update`       | Update pesanan (status, berat, harga, foto) |
| `GET`  | `/admin/messages`                 | `Admin::messages`           | Daftar pesan kontak dari pelanggan     |
| `GET`  | `/admin/settings`                 | `Admin::settings`           | Halaman pengaturan toko               |
| `POST` | `/admin/settings/update`          | `Admin::settings_update`    | Update pengaturan toko                |
| `POST` | `/admin/password/update`          | `Admin::password_update`    | Ganti password admin                  |

### Detail: `POST /admin/order/update`

| Parameter      | Tipe     | Wajib | Deskripsi                          |
|----------------|----------|-------|------------------------------------|
| `id`           | `int`    | ✅    | ID pesanan                         |
| `weight`       | `float`  | ❌    | Berat cucian (kg)                  |
| `total_price`  | `int`    | ❌    | Total harga                        |
| `status`       | `string` | ❌    | Status pesanan (`Pending`/`Proses`/`Selesai`) |
| `laundry_photo`| `file`   | ❌    | Foto cucian (upload ke `uploads/laundry/`) |

### Detail: `POST /admin/settings/update`

| Parameter        | Tipe     | Wajib | Deskripsi                     |
|------------------|----------|-------|-------------------------------|
| `price_daily`    | `int`    | ❌    | Harga Daily Kiloan            |
| `price_express`  | `int`    | ❌    | Harga Express Kiloan          |
| `price_dry`      | `int`    | ❌    | Harga Cuci Kering             |
| `price_iron`     | `int`    | ❌    | Harga Setrika Saja            |
| `price_complete` | `int`    | ❌    | Harga Cuci & Setrika          |
| `bank_name`      | `string` | ❌    | Nama bank                     |
| `bank_number`    | `string` | ❌    | Nomor rekening                |
| `bank_holder`    | `string` | ❌    | Nama pemilik rekening         |
| `whatsapp_admin` | `string` | ❌    | Nomor WhatsApp admin          |
| `qris_image`     | `file`   | ❌    | Gambar QRIS (upload ke `assets/img/`) |

### Detail: `POST /admin/password/update`

| Parameter          | Tipe     | Wajib | Deskripsi                  |
|--------------------|----------|-------|-----------------------------|
| `old_password`     | `string` | ✅    | Password lama               |
| `new_password`     | `string` | ✅    | Password baru               |
| `confirm_password` | `string` | ✅    | Konfirmasi password baru    |

---

## Database Schema

### Tabel `users`

| Kolom           | Tipe         | Deskripsi                              |
|-----------------|--------------|----------------------------------------|
| `id`            | `int` (AI)   | Primary key                            |
| `username`      | `string`     | Username unik                          |
| `password`      | `string`     | Password (bcrypt hash)                 |
| `fullname`      | `string`     | Nama lengkap                           |
| `phone`         | `string`     | Nomor telepon                          |
| `address`       | `string`     | Alamat                                 |
| `profile_image` | `string`     | Nama file foto profil                  |
| `role`          | `string`     | Role user (`user` / `admin`)           |
| `created_at`    | `datetime`   | Tanggal pembuatan akun                 |

### Tabel `user_token`

| Kolom      | Tipe       | Deskripsi                              |
|------------|------------|----------------------------------------|
| `user_id`  | `int`      | Foreign key ke `users.id`              |
| `auth_key` | `string`   | Token autentikasi (100 char random)    |

### Tabel `orders`

| Kolom            | Tipe         | Deskripsi                                  |
|------------------|--------------|--------------------------------------------|
| `id`             | `int` (AI)   | Primary key                                |
| `user_id`        | `int`        | Foreign key ke `users.id`                  |
| `service_name`   | `string`     | Nama layanan yang dipilih                  |
| `fullname`       | `string`     | Nama pemesan                               |
| `whatsapp`       | `string`     | Nomor WhatsApp pemesan                     |
| `address`        | `string`     | Alamat penjemputan                         |
| `pickup_time`    | `string`     | Waktu penjemputan                          |
| `notes`          | `string`     | Catatan tambahan                           |
| `resi_code`      | `string`     | Kode resi unik (format: `TRX-XXXXX`)      |
| `status`         | `string`     | Status pesanan (`Pending`/`Proses`/`Selesai`) |
| `payment_method` | `string`     | Metode pembayaran                          |
| `weight`         | `float`      | Berat cucian (diisi admin)                 |
| `total_price`    | `int`        | Total harga (diisi admin)                  |
| `payment_proof`  | `string`     | Nama file bukti pembayaran                 |
| `laundry_photo`  | `string`     | Nama file foto cucian (diisi admin)        |
| `created_at`     | `datetime`   | Tanggal pembuatan pesanan (auto)           |
| `updated_at`     | `datetime`   | Tanggal update terakhir (auto)             |

### Tabel `messages`

| Kolom       | Tipe         | Deskripsi                          |
|-------------|--------------|------------------------------------|
| `id`        | `int` (AI)   | Primary key                        |
| `name`      | `string`     | Nama pengirim                      |
| `whatsapp`  | `string`     | Nomor WhatsApp pengirim            |
| `message`   | `string`     | Isi pesan                          |
| `created_at`| `datetime`   | Tanggal pengiriman (auto)          |

### Tabel `settings`

| Kolom            | Tipe       | Deskripsi                            |
|------------------|------------|--------------------------------------|
| `id`             | `int` (AI) | Primary key (hanya 1 row, ID = 1)   |
| `price_daily`    | `int`      | Harga Daily Kiloan per kg            |
| `price_express`  | `int`      | Harga Express Kiloan per kg          |
| `price_dry`      | `int`      | Harga Cuci Kering per kg             |
| `price_iron`     | `int`      | Harga Setrika Saja per kg            |
| `price_complete` | `int`      | Harga Cuci & Setrika per kg          |
| `desc_daily`     | `string`   | Deskripsi Daily Kiloan               |
| `desc_express`   | `string`   | Deskripsi Express Kiloan             |
| `desc_dry`       | `string`   | Deskripsi Cuci Kering                |
| `desc_iron`      | `string`   | Deskripsi Setrika Saja               |
| `desc_complete`  | `string`   | Deskripsi Cuci & Setrika             |
| `bank_name`      | `string`   | Nama bank untuk transfer             |
| `bank_number`    | `string`   | Nomor rekening bank                  |
| `bank_holder`    | `string`   | Nama pemilik rekening                |
| `whatsapp_admin` | `string`   | Nomor WhatsApp admin                 |
| `qris_image`     | `string`   | Nama file gambar QRIS                |

---

## Konfigurasi CORS

CORS diaktifkan secara global melalui filter. Konfigurasi:

```php
'allowedOriginsPatterns' => ['http://localhost(:\d+)?'],
'supportsCredentials'    => false,
'allowedHeaders'         => ['Content-Type', 'Authorization', 'X-Requested-With'],
'allowedMethods'         => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
'maxAge'                 => 7200,
```

> **Catatan:** Saat production, tambahkan domain production ke `allowedOrigins` atau `allowedOriginsPatterns`.

Semua route `OPTIONS` pada endpoint API telah didefinisikan untuk mendukung preflight request CORS:
- `OPTIONS /api/registrasi`
- `OPTIONS /api/login`
- `OPTIONS /api/logout`
- `OPTIONS /api/profile`
- `OPTIONS /api/profile/update`

---

## Alur Status Pesanan

```
[User Buat Pesanan] → Pending → [Admin Update] → Proses → [Admin Update] → Selesai
```

| Status    | Deskripsi                                        |
|-----------|--------------------------------------------------|
| `Pending` | Pesanan baru dibuat, menunggu konfirmasi admin    |
| `Proses`  | Pesanan sedang dikerjakan                        |
| `Selesai` | Pesanan telah selesai                            |

---

## File Upload Paths

| Jenis File          | Path Upload             | Digunakan Oleh          |
|---------------------|-------------------------|-------------------------|
| Foto profil user    | `uploads/profile/`      | `Profile::update`       |
| Bukti pembayaran    | `uploads/payments/`     | `Transaksi::upload_bukti` |
| Foto cucian (admin) | `uploads/laundry/`      | `Admin::order_update`   |
| Gambar QRIS         | `assets/img/`           | `Admin::settings_update` |

---

> 📝 **Dokumen ini di-generate berdasarkan source code project Freshora Laundry.**  
> **Terakhir diperbarui:** 11 Juli 2026
