<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Specialty;
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
            'id' => '1',
            'role_id' => '1',
            'name_es' => 'Soporte Técnico',
            'name_en' => 'Tech support',
            'active' => true,
            'show' => false
        ]);
        Specialty::create([
            'id' => '2',
            'role_id' => '2',
            'name_es' => 'Super Admin',
            'name_en' => 'Super Admin',
            'active' => true,
            'show' => false
        ]);
    	Specialty::create([
            'id' => '3',
            'role_id' => '3',
            'name_es' => 'Administración',
            'name_en' => 'Administration',
            'active' => true,
            'show' => true
        ]);
    	Specialty::create([
            'id' => '4',
            'role_id' => '4',
            'name_es' => 'Dental',
            'name_en' => 'Dental',
            'active' => true,
            'show' => true
        ]);
    	Specialty::create([
            'id' => '5',
            'role_id' => '4',
            'name_es' => 'Cardiología',
            'name_en' => 'Cardiology',
            'active' => true,
            'show' => true
        ]);
    	Specialty::create([
            'id' => '6',
            'role_id' => '4',
            'name_es' => 'Bariatría',
            'name_en' => 'Bariatrics',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '7',
            'role_id' => '4',
            'name_es' => 'Urología',
            'name_en' => 'Urology',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '8',
            'role_id' => '4',
            'name_es' => 'Cirugía plástica',
            'name_en' => 'Plastic surgery',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '9',
            'role_id' => '5',
            'name_es' => 'Enfermería',
            'name_en' => 'Nursing',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '10',
            'role_id' => '6',
            'name_es' => 'Cordinación',
            'name_en' => 'Cordinator',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '11',
            'role_id' => '7',
            'name_es' => 'Transporte',
            'name_en' => 'Transport',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '12',
            'role_id' => '4',
            'name_es' => 'Endoscopia',
            'name_en' => 'Endoscopy',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '13',
            'role_id' => '4',
            'name_es' => 'Traumatología',
            'name_en' => 'Traumatology',
            'active' => true,
            'show' => true
        ]);
        Specialty::create([
            'id' => '14',
            'role_id' => '4',
            'name_es' => 'Análisis de sangre',
            'name_en' => 'Blood Work',
            'active' => true,
            'show' => true
        ]);
    }
}
