<?php

namespace Database\Seeders;

use Database\Seeders\Site\CountrySeeder;
use Database\Seeders\Site\FaqSeeder;
use Database\Seeders\Site\StateSeeder;
use Database\Seeders\Staff\BrandSeeder;
use Database\Seeders\Staff\PackageSeeder;
use Database\Seeders\Staff\PaymentMethodSeeder;
use Database\Seeders\Staff\PermissionsSeeder;
use Database\Seeders\Staff\ProcedureSeeder;
use Database\Seeders\Staff\RolesSeeder;
use Database\Seeders\Staff\ServiceSeeder;
use Database\Seeders\Staff\SpecialtySeeder;
use Database\Seeders\Staff\StaffSeeder;
use Database\Seeders\Staff\StatusSeeder;
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
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
		$this->call(SpecialtySeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(ProcedureSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(StatusSeeder::class);
        //$this->call(DummySeeder::class);
    }
}
