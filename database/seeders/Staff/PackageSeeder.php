<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                'id' => 1,
                'package_en' => 'Basic',
                'package_es' => 'Básico',
            ],
            [
                'id' => 2,
                'package_en' => 'Basic Plus',
                'package_es' => 'Básico Plus',
            ],
            [
                'id' => 3,
                'package_en' => 'Premium',
                'package_es' => 'Premium',
            ],
            [
                'id' => 4,
                'package_en' => 'Premium Plus',
                'package_es' => 'Premium Plus',
            ]
        ]);
    }
}
