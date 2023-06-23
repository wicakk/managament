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
        Schema::create('project_detail', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('task_name');
            $table->string('assigned_to');
            $table->string('due_dates');
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->text('checklist')->nullable();
            $table->string('created_by')->nullable();
            $table->string('tested_by')->nullable();
            $table->string('file_dev')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
