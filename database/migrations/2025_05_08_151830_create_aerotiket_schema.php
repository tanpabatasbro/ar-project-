<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAerotiketSchema extends Migration
{
    public function up(): void
    {
        // 1. Users
        

        // 2. Airlines
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // ex: GA
            $table->string('logo')->nullable();
        });

        // 3. Airports
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('code', 3)->unique(); // IATA 3-letter code
        });

        // 4. Flights
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->foreignId('departure_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('arrival_id')->constrained('airports')->onDelete('cascade');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->decimal('price', 10, 2);
            $table->integer('seats');
        });

        // 5. Bookings
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->dateTime('booking_time');
            $table->enum('status', ['booked', 'cancelled', 'checked-in']);
            $table->decimal('total_price', 10, 2);
        });

        // 6. Passengers
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('full_name');
            $table->string('passport_no')->nullable(); // bisa juga KTP
            $table->string('seat_number');
        });

        // 7. Reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // 1–5
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('passengers');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('flights');
        Schema::dropIfExists('airports');
        Schema::dropIfExists('airlines');
        Schema::dropIfExists('users');
    }
}
