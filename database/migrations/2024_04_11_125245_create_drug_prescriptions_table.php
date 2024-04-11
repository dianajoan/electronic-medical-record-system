<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_record_id');
            $table->string('drug_name');
            $table->text('dosage_instructions');
            $table->dateTime('prescription_date');
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
        Schema::dropIfExists('drug_prescriptions');
    }
}
