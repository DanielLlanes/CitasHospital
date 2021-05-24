<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dios = Role::create([
            'id' => 1,
            'name' => 'dios',
            'guard_name' => 'staff',
            'name_es' => 'Soporte Técnico',
            'name_en' => 'Tech support',
            'active' => false,
            'show' => false
        ]);


        $superAdmin = Role::create([
            'id' => 2,
            'name' => 'super-administrator',
            'guard_name' => 'staff',
            'name_es' => 'Super Administrador',
            'name_en' => 'Super Administrador',
            'active' => false,
            'show' => false
        ]);

        $Admin = Role::create([
            'id' => 3,
            'name' => 'administrator',
            'guard_name' => 'staff',
            'name_es' => 'Administrador',
            'name_en' => 'Administrator',
        ]);

        $role = Role::create([
            'id' => 4,
            'name' => 'doctor',
            'guard_name' => 'staff',
            'name_es' => 'Doctor',
            'name_en' => 'Doctor',
        ]);

        $role = Role::create([
            'id' => 5,
            'name' => 'nurse',
            'guard_name' => 'staff',
            'name_es' => 'Emfermero',
            'name_en' => 'Nurse',
        ]);

        $role = Role::create([
            'id' => 6,
           'name' => 'coordinador',
           'guard_name' => 'staff',
           'name_es' => 'Coordinador',
           'name_en' => 'Coordinator',
        ]);

        $role = Role::create([
            'id' => 7,
            'name' => 'driver',
            'guard_name' => 'staff',
            'name_es' => 'Chofer',
            'name_en' => 'Driver',
        ]);
        $dios->givePermissionTo(Permission::all());
        $superAdmin->givePermissionTo(Permission::all());
    }
}
