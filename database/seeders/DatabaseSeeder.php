<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Staff\BrandSeeder;
use Database\Seeders\Staff\RolesSeeder;
use Database\Seeders\Staff\StaffSeeder;
use Database\Seeders\Staff\ServiceSeeder;
use Database\Seeders\Staff\SpecialtySeeder;
use Database\Seeders\Staff\PermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
		$this->call(SpecialtySeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(DummySeeder::class);
    }
}
