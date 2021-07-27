<?php

namespace Database\Seeders;

use App\Models\Staff\Patient;
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
        $patient = Patient::factory(50)->create()->each(function ($staff) {

         });
    }
}
