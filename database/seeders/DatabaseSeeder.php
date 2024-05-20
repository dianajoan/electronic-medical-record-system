<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            UserRolesTableSeeder::class,
            GeneralTestsTableSeeder::class,
            DiagnosesTableSeeder::class,
            ClinicsTableSeeder::class,
            DrugsTableSeeder::class,
            PatientsTableSeeder::class,
            MedicalRecordsTableSeeder::class,
            LabTestsSeeder::class,
            LabTestOrdersSeeder::class,
            LabResultSeeder::class,
            AppointmentsTableSeeder::class,
            DrugPrescriptionSeeder::class,
        ]);
    }
}
