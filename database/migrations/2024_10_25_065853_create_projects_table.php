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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('id');
            $table->string('projectName');
            $table->string('projectDev');
            $table->text('description')->nullable();
            $table->string('officerCharge');
            $table->date('dateStarted');
            $table->date('dateEnded')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
