<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_record_id');
            $table->string('test_name');
            $table->text('result_details');
            $table->dateTime('result_date');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamps();
            $table->softDeletes(); // Enables soft deletes
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results');
    }
}
