<h1 align="center">✈️ AeroTiket – Sistem Penjualan Tiket Pesawat</h1>

<p align="center">
  <img src="public/assets/img/LogoUnsulbar 1.png" alt="Logo Universitas Sulawesi Barat" width="120"/>
</p>

<p align="center">
 <b>Kelas F</b><br>
 <b>M. Arming</b><br>
 <b>D0222365</b>
</p>

<p align="center">
  <strong>Framework Web Based</strong><br>
  Program Studi Informatika<br>
  Fakultas Teknik<br>
  Universitas Sulawesi Barat<br>
  Majene, 2025
</p>

---

## 🎯 Role dan Fitur-fiturnya

### 1. Admin
- Mengelola data maskapai, jadwal penerbangan, dan bandara.
- Melihat laporan penjualan tiket.
- Mengelola data pengguna dan sistem.

### 2. Petugas Loket
- Melayani pemesanan dan pembatalan tiket secara langsung.
- Mencetak tiket dan mengatur status check-in.

### 3. Penumpang
- Melihat jadwal penerbangan dan ketersediaan kursi.
- Melakukan pemesanan dan pembayaran tiket.
- Melakukan check-in online dan mencetak boarding pass.
- Memberikan ulasan penerbangan.

---

## 🗂️ Struktur Tabel Database

### 1. Tabel `users`

| Nama Field | Tipe Data | Keterangan                    |
| ---------- | --------- | ----------------------------- |
| id         | INT, PK   | ID unik pengguna              |
| name       | VARCHAR   | Nama pengguna                 |
| email      | VARCHAR   | Email unik                    |
| password   | VARCHAR   | Kata sandi                    |
| role       | ENUM      | ['admin', 'petugas', 'penumpang'] |
| created_at | TIMESTAMP | Tanggal dibuat                |

### 2. Tabel `airlines`

| Nama Field | Tipe Data | Keterangan         |
| ---------- | --------- | ------------------ |
| id         | INT, PK   | ID maskapai        |
| name       | VARCHAR   | Nama maskapai      |
| code       | VARCHAR   | Kode maskapai (ex: GA) |
| logo       | VARCHAR   | URL logo maskapai  |

### 3. Tabel `airports`

| Nama Field | Tipe Data | Keterangan        |
| ---------- | --------- | ----------------- |
| id         | INT, PK   | ID bandara        |
| name       | VARCHAR   | Nama bandara      |
| city       | VARCHAR   | Kota              |
| code       | VARCHAR   | Kode IATA (ex: CGK) |

### 4. Tabel `flights`

| Nama Field     | Tipe Data | Keterangan                                |
| -------------- | --------- | ----------------------------------------- |
| id             | INT, PK   | ID penerbangan                            |
| airline_id     | INT       | FK ke airlines                            |
| departure_id   | INT       | FK ke airports (bandara keberangkatan)    |
| arrival_id     | INT       | FK ke airports (bandara tujuan)           |
| departure_time | DATETIME  | Waktu keberangkatan                       |
| arrival_time   | DATETIME  | Waktu kedatangan                          |
| price          | DECIMAL   | Harga tiket                               |
| seats          | INT       | Jumlah kursi tersedia                     |

### 5. Tabel `bookings`

| Nama Field | Tipe Data | Keterangan                           |
| ---------- | --------- | ------------------------------------ |
| id         | INT, PK   | ID pemesanan                         |
| user_id    | INT       | FK ke users                          |
| flight_id  | INT       | FK ke flights                        |
| booking_time | DATETIME | Waktu pemesanan                     |
| status     | ENUM      | ['booked', 'cancelled', 'checked-in'] |
| total_price | DECIMAL  | Total harga tiket                    |

### 6. Tabel `passengers`

| Nama Field  | Tipe Data | Keterangan           |
| ----------- | --------- | -------------------- |
| id          | INT, PK   | ID penumpang         |
| booking_id  | INT       | FK ke bookings       |
| full_name   | VARCHAR   | Nama lengkap         |
| passport_no | VARCHAR   | Nomor paspor/KTP     |
| seat_number | VARCHAR   | Nomor kursi          |

### 7. Tabel `reviews`

| Nama Field | Tipe Data | Keterangan            |
| ---------- | --------- | --------------------- |
| id         | INT, PK   | ID ulasan             |
| user_id    | INT       | FK ke users           |
| flight_id  | INT       | FK ke flights         |
| rating     | INT       | Nilai 1–5             |
| comment    | TEXT      | Isi ulasan            |
| created_at | TIMESTAMP | Tanggal dibuat        |

---

## 🔁 Relasi Antar Tabel

- `users` ↔ `bookings` : One-to-Many  
- `bookings` ↔ `passengers` : One-to-Many  
- `flights` ↔ `bookings` : One-to-Many  
- `flights` ↔ `reviews` : One-to-Many  
- `users` ↔ `reviews` : One-to-Many  
- `flights` memiliki relasi dengan `airports` sebagai bandara asal dan tujuan  

---
