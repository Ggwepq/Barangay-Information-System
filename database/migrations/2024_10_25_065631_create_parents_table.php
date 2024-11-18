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
        Schema::create('parents', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('residentId')->constrained('residents')->onDelete('restrict')->onUpdate('restrict');
            $table->string('motherfirstName')->nullable();
            $table->string('mothermiddleName')->nullable();
            $table->string('motherlastName')->nullable();
            $table->string('fatherfirstName')->nullable();
            $table->string('fathermiddleName')->nullable();
            $table->string('fatherlastName')->nullable();
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
