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
        Schema::create('project_detail_uat', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('uat_test_case');
            $table->string('uat_test_desc');
            $table->string('uat_test_detail');
            $table->text('steps_for_uat_test');
            $table->text('expected_result');
            $table->string('actual_result')->nullable();;
            $table->string('result')->nullable();;
            $table->text('comments')->nullable();;
            $table->string('created_by')->nullable();;
            $table->string('tested_by')->nullable();;
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
