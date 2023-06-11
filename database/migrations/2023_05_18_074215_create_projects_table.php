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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_project');
            $table->string('waktu_mulai')->nullable();
            $table->string('waktu_selesai')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('deadline_plan')->nullable();
            $table->string('deadline_design')->nullable();
            $table->string('deadline_implementasi')->nullable();
            $table->string('deadline_evolution')->nullable();
            // $table->string('file_plan')->nullable();
            // $table->string('desc_plan')->nullable();
            // $table->string('file_design')->nullable();
            // $table->string('desc_design')->nullable();
            // $table->string('file_evolution')->nullable();
            // $table->string('desc_evolution')->nullable();
            $table->string('created_by');
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
