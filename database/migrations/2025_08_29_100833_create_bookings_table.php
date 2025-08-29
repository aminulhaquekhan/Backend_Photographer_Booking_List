<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->string('event_type'); // Wedding, Birthday, Corporate, etc.
            $table->date('event_date');
            $table->string('location');
            $table->unsignedBigInteger('photographer_id')->nullable();
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('photographer_id')->references('id')->on('photographers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};