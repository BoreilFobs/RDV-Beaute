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
        Schema::create('offer_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignid("offer_id")->on("offers");
            $table->foreignid("material_id")->on("materials");
            $table->float("quantity");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_materials');
    }
};
