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
          $table->unsignedBigInteger('lab_test_order_id');  
            $table->unsignedBigInteger('authenticated_by');
            $table->text('result_details');
            $table->dateTime('result_date');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamps();
            $table->softDeletes(); // Enables soft deletes

            $table->foreign('lab_test_order_id')->references('id')->on('lab_test_orders')->onDelete('cascade');
            $table->foreign('authenticated_by')->references('id')->on('users')->onDelete('cascade');

            // Adding created_by, updated_by, and deleted_by columns
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            // Optionally, you can add foreign key constraints if you have a users table
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
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
