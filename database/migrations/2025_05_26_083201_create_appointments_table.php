<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->on("users");
            $table->foreignId("offer_id")->on("offers");
            $table->date("date");
            $table->time("time");
            $table->string("name");
            $table->string("phone");
            $table->text("special_requests")->nullable();
            $table->enum("status", ['pending', 'confirmed', 'cancelled', 'rejected', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
