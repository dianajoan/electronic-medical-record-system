<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabResult;
use App\Models\LabTestOrder;
use App\Models\User;
use Carbon\Carbon;

class LabResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are some users and lab test orders to reference
        $users = User::all();
        $labTestOrders = LabTestOrder::all();

        if ($users->count() == 0 || $labTestOrders->count() == 0) {
            $this->command->info('Please seed the users and lab test orders tables first!');
            return;
        }

        // Generate sample lab results
        foreach ($labTestOrders as $order) {
            LabResult::create([
                'lab_test_order_id' => $order->id,
                'authenticated_by' => $users->random()->id,
                'result_details' => 'Sample result details for lab test order ' . $order->id,
                'result_date' => Carbon::now(),
                'status' => 'active',
                'created_by' => $users->random()->id,
                'updated_by' => $users->random()->id,
            ]);
        }
    }
}
