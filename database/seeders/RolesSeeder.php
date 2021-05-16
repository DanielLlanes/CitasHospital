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
        // DB::table('roles')->insert([
        //     [
        //         'id' => 1,
        //         'name' => 'dios',
        //         'name_es' => 'Dios',
        //         'name_en' => 'God',
        //         'guard_name' => 'staff',
        //         'active' => false,
        //         'show' => false,
        //         'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'administrator',
        //         'name_es' => 'Administrador',
        //         'name_en' => 'Administrator',
        //         'guard_name' => 'staff',
        //         'active' => true,
        //         'show' => true,
        //         'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'doctor',
        //         'name_es' => 'Doctor',
        //         'name_en' => 'Doctor',
        //         'guard_name' => 'staff',
        //         'active' => true,
        //         'show' => true,
        //         'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         'id' => 4,
        //         'name' => 'nurse',
        //         'name_es' => 'Emfermero',
        //         'name_en' => 'Nurse',
        //         'guard_name' => 'staff',
        //         'active' => true,
        //         'show' => true,
        //         'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         'id' => 5,
        //         'name' => 'coordinador',
        //         'name_es' => 'Coordinador',
        //         'name_en' => 'Coordinator',
        //         'guard_name' => 'staff',
        //         'active' => true,
        //         'show' => true,
        //         'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         'id' => 6,
        //         'name' => 'driver',
        //         'name_es' => 'Chofer',
        //         'name_en' => 'Driver',
        //         'guard_name' => 'staff',
        //         'active' => true,
        //         'show' => true,
        //         'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_ats' => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        // ]);
        $dios = Role::create([
            'id' => 1,
            'name' => 'dios',
            'guard_name' => 'staff',
            'name_es' => 'Dios',
            'name_en' => 'God',
            'active' => false,
            'show' => false
        ]);

        $admin = Role::create([
            'id' => 2,
            'name' => 'administrator',
            'guard_name' => 'staff',
            'name_es' => 'Administrador',
            'name_en' => 'Administrator',
        ]);

        $role = Role::create([
            'id' => 3,
            'name' => 'doctor',
            'guard_name' => 'staff',
            'name_es' => 'Doctor',
            'name_en' => 'Doctor',
        ]);

        $role = Role::create([
            'id' => 4,
            'name' => 'nurse',
            'guard_name' => 'staff',
            'name_es' => 'Emfermero',
            'name_en' => 'Nurse',
        ]);

        $role = Role::create([
            'id' => 5,
           'name' => 'coordinador',
           'guard_name' => 'staff',
           'name_es' => 'Coordinador',
           'name_en' => 'Coordinator',
        ]);

        $role = Role::create([
            'id' => 6,
            'name' => 'driver',
            'guard_name' => 'staff',
            'name_es' => 'Chofer',
            'name_en' => 'Driver',
        ]);
        $dios->givePermissionTo(Permission::all());
        $adminRole = [
            "calendar.edit",
            "calendar.list",
            "calendar.create",
            "calendar.destroy",
            "team.list",
            "team.create",
            "team.edit",
            "team.destroy",
            "applications.list",
            "applications.details",
            "applications.create",
            "applications.edit",
            "applications.setprice",
            "applications.changeStaff",
            "patients.list",
            "patients.create",
            "patients.edit",
            "patients.destroy",
            "patients.details",
            "procedures.list",
            "procedures.create",
            "procedures.edit",
            "procedures.destroy",
            "payments.list",
            "payments.create",
            "payments.edit",
            "payments.destroy",
            "specialties.list",
            "specialties.create",
            "specialties.edit",
            "specialties.destroy",
            "services.list",
            "services.create",
            "services.edit",
            "packages.list",
            "packages.create",
            "packages.edit"
        ];
        $admin->givePermissionTo($adminRole);
    }
}
