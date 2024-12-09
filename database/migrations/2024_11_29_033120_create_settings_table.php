<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_name');
            $table->string('logo')->nullable();
            $table->string('zone')->nullable();
            $table->string('district')->nullable();
            $table->string('city');
            $table->string('province');
            $table->enum('notification_method', ['SMS', 'EMAIL'])->default('EMAIL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
