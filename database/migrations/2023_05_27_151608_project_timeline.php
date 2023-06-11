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
        Schema::create('project_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('created_by');
            $table->string('jenis_timeline');
            $table->string('file_upload')->nullable();
            $table->string('desc_timeline')->nullable();
            $table->string('scope')->nullable();
            $table->string('task')->nullable();

            // $table->string('status')->nullable();
            // $table->string('desc_update')->nullable();
            $table->string('updated_by')->nullable();
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
