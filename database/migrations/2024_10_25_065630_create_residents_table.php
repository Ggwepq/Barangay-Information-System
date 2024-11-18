<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id('id');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('province')->nullable();
            $table->string('street');
            $table->string('brgy');
            $table->string('city');
            $table->string('citizenship');
            $table->string('religion');
            $table->string('dateCitizen')->nullable();
            $table->string('orderApproval')->nullable();
            $table->string('occupation')->nullable();
            $table->string('tinNo')->nullable();
            $table->string('isUnpleasant')->default('Good');
            $table->boolean('gender');
            $table->date('birthdate');
            $table->string('birthPlace');
            $table->string('civilStatus');
            $table->string('periodResidence');
            $table->string('contactNumber')->nullable();
            $table->string('image')->nullable();
            $table->boolean('isDerogatory')->default(1);
            $table->boolean('isRegistered')->default(1);
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
