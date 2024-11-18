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
        Schema::create('blotters', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('complainant')->constrained('residents')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('complainedResident')->constrained('residents')->onDelete('restrict')->onUpdate('restrict');
            $table->string('officerCharge');
            $table->text('description');
            $table->integer('status')->default(1);
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};
