<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = Staff::factory(50)->create()->each(function ($staff) {
         	$staff->assignRole(rand(2,6));
            $staff->syncPermissions(rand(1, 37));
         });
        $patient = Patient::factory(50)->create()->each(function ($staff) {

         });
    }
}
