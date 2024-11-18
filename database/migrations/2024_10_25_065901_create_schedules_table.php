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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('residentId')->constrained('residents')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('officerId')->constrained('officers')->onDelete('restrict')->onUpdate('restrict');
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->boolean('isActive', 1)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
