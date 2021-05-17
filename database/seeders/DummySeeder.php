<?php

namespace Database\Seeders;

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
        $staff = Staff::factory(5000)->create()->each(function ($staff) {
    		$staff->assignRole(rand(2,6));
    	});
    }
}
