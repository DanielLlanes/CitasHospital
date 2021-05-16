<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialty::create([
            'role_id' => '1',
            'name_es' => 'Soporte Técnico',
            'name_en' => 'Tech support',
            'active' => false,
            'show' => false
        ]);
    	Specialty::create([
            'role_id' => '2',
            'name_es' => 'Administración',
            'name_en' => 'Administration',
            'active' => true,
            'show' => true
        ]);
    	Specialty::create([
            'role_id' => '3',
            'name_es' => 'Dental',
            'name_en' => 'Dental',
            'active' => true,
            'show' => true
        ]);
    	Specialty::create([
            'role_id' => '3',
            'name_es' => 'Cardiología',
            'name_en' => 'Cardiology',
            'active' => true,
            'show' => true
        ]);
    	Specialty::create([
            'role_id' => '3',
            'name_es' => 'Bariatría',
            'name_en' => 'Bariatrics',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'role_id' => '3',
            'name_es' => 'Urología',
            'name_en' => 'Urology',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'role_id' => '3',
            'name_es' => 'Cirugía plástica',
            'name_en' => 'Plastic surgery',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'role_id' => '4',
            'name_es' => 'Enfermería',
            'name_en' => 'Nursing',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'role_id' => '5',
            'name_es' => 'Ventas',
            'name_en' => 'Sales',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'role_id' => '6',
            'name_es' => 'Transporte',
            'name_en' => 'Transport',
            'active' => true,
            'show' => true
        ]);
    }
}
