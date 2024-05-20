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
            $table->unsignedBigInteger('patient_id');
            $table->enum('stock', ['in_stock', 'not_in_stock'])->default('not_in_stock');
            $table->json('dosage_instructions'); // This will store JSON instructions for each drug
            $table->dateTime('prescription_date');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
            $table->softDeletes(); // Enables soft deletes

            // Foreign key constraints
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            // Adding created_by, updated_by, and deleted_by columns
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            // Optionally, you can add foreign key constraints if you have a users table
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('drug_prescription_drug', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drug_prescription_id');
            $table->unsignedBigInteger('drug_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('drug_prescription_id')->references('id')->on('drug_prescriptions')->onDelete('cascade');
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
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
