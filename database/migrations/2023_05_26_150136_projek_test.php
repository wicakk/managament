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
        Schema::create('project_test', function (Blueprint $table) {
            $table->id();
            $table->string('project_detail_id');
            $table->string('uat_test_case')->nullable();
            $table->string('uat_test_desc')->nullable();
            $table->string('uat_test_detail')->nullable();
            $table->text('steps_for_uat_test')->nullable();
            $table->text('expected_result')->nullable();
            $table->string('actual_result_qa')->nullable();
            $table->string('result_qa')->nullable();
            $table->text('comments_qa')->nullable();
            $table->text('file_test_qa')->nullable();
            $table->text('link_test')->nullable();
            $table->string('actual_result')->nullable();
            $table->string('result')->nullable();
            $table->text('comments')->nullable();
            $table->string('created_by')->nullable();
            $table->string('tested_by')->nullable();
            $table->string('url_test')->nullable();
            $table->string('file_test')->nullable();
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
