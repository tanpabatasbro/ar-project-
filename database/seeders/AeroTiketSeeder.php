<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AeroTiketSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        DB::table('users')->insert([
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Petugas Loket', 'email' => 'petugas@example.com', 'password' => Hash::make('password'), 'role' => 'petugas'],
            ['name' => 'Penumpang Satu', 'email' => 'penumpang1@example.com', 'password' => Hash::make('password'), 'role' => 'penumpang'],
        ]);

        // 2. Airlines
        DB::table('airlines')->insert([
            ['name' => 'Garuda Indonesia', 'code' => 'GA', 'logo' => 'ga.png'],
            ['name' => 'Lion Air', 'code' => 'JT', 'logo' => 'jt.png'],
        ]);

        // 3. Airports
        DB::table('airports')->insert([
            ['name' => 'Soekarno-Hatta', 'city' => 'Jakarta', 'code' => 'CGK'],
            ['name' => 'Ngurah Rai', 'city' => 'Bali', 'code' => 'DPS'],
        ]);

        // 4. Flights
        DB::table('flights')->insert([
            [
                'airline_id' => 1,
                'departure_id' => 1,
                'arrival_id' => 2,
                'departure_time' => Carbon::now()->addDays(1),
                'arrival_time' => Carbon::now()->addDays(1)->addHours(2),
                'price' => 1500000,
                'seats' => 100,
            ],
        ]);

        // 5. Bookings
        DB::table('bookings')->insert([
            [
                'user_id' => 3,
                'flight_id' => 1,
                'booking_time' => Carbon::now(),
                'status' => 'booked',
                'total_price' => 1500000,
            ],
        ]);

        // 6. Passengers
        DB::table('passengers')->insert([
            [
                'booking_id' => 1,
                'full_name' => 'Penumpang Satu',
                'passport_no' => 'ID12345678',
                'seat_number' => '12A',
            ],
        ]);

        // 7. Reviews
        DB::table('reviews')->insert([
            [
                'user_id' => 3,
                'flight_id' => 1,
                'rating' => 5,
                'comment' => 'Penerbangan nyaman dan tepat waktu.',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
