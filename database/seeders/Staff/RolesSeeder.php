<?php

namespace Database\Seeders\Staff;

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

        $admin = Role::create([
            'id' => 3,
            'name' => 'administrator',
            'guard_name' => 'staff',
            'name_es' => 'Administrador',
            'name_en' => 'Administrator',
        ]);

        $doctor = Role::create([
            'id' => 4,
            'name' => 'doctor',
            'guard_name' => 'staff',
            'name_es' => 'Doctor',
            'name_en' => 'Doctor',            
        ]);

        $nurse = Role::create([
            'id' => 5,
            'name' => 'nurse',
            'guard_name' => 'staff',
            'name_es' => 'Emfermero',
            'name_en' => 'Nurse',
        ]);

        $coordinator = Role::create([
            'id' => 6,
            'name' => 'coordinator',
            'guard_name' => 'staff',
            'name_es' => 'Coordinador',
            'name_en' => 'Coordinator',
        ]);

        $driver = Role::create([
            'id' => 7,
            'name' => 'driver',
            'guard_name' => 'staff',
            'name_es' => 'Chofer',
            'name_en' => 'Driver',
        ]);

        $supervisor = Role::create([
            'id' => 8,
            'name' => 'supervisor',
            'guard_name' => 'staff',
            'name_es' => 'Supervisór',
            'name_en' => 'Supervisor',
        ]);

        $recepcionist = Role::create([
            'id' => 9,
            'name' => 'reception',
            'guard_name' => 'staff',
            'name_es' => 'Recepción',
            'name_en' => 'Reception',
        ]);

        $doctorPermissions = [
            "calendar.show",
            "calendar.list",
            "applications.list",
            "applications.show",
            "applications.details",
            "applications.debate",
        ];

        $nursePermissions = [
            "applications.list",
            "applications.show",
            "applications.details",
            "applications.all",
            "calendar.show",
            "calendar.list",
        ];

        $driverPermissions = [
            "calendar.show",
            "calendar.list",
            "applications.list",
            "applications.show",
            "applications.all",
        ];

        $adminPermissions = [
            "calendar.edit",
            "calendar.list",
            "calendar.create",
            "calendar.destroy",
            "calendar.show",

            "staff.list",
            "staff.create",
            "staff.edit",
            "staff.destroy",
            "staff.activate",
            "staff.show",
            "staff.reset.password",
            "staff.permisions",
            "staff.publicProfile",

            "admin.list",
            "admin.create",
            "admin.edit",
            "admin.destroy",
            "admin.activate",
            "admin.show",
            "admin.reset.password",
            "admin.permisions",

            "applications.list",
            "applications.all",
            "applications.edit",
            "applications.create",
            "applications.destroy",
            "applications.details",
            "applications.setprice",
            "applications.changeCoordinator",
            "applications.changeStaff",
            "applications.show",
            "applications.debate",
            "applications.timeline",
            "applications.logisticNotes",

            "patients.list",
            "patients.create",
            "patients.edit",
            "patients.destroy",
            "patients.details",
            "patients.show",

            "payments.list",
            "payments.create",
            "payments.edit",
            "payments.destroy",
            "payments.show",
            "payments.details",

            "specialties.list",
            "specialties.create",
            "specialties.edit",
            "specialties.destroy",
            "specialties.activate",

            "services.list",
            "services.create",
            "services.edit",
            "services.destroy",
            "services.activate",

            "packages.list",
            "packages.create",
            "packages.edit",
            "packages.destroy",
            "packages.activate",

            "brand.list",
            "brand.create",
            "brand.edit",
            "brand.destroy",
            "brand.activate",

            "procedures.list",
            "procedures.create",
            "procedures.edit",
            "procedures.destroy",
            "procedures.activate",

            'treatment.list',
            'treatment.edit',
            'treatment.create',
            'treatment.destroy',
            'treatment.activate',

            'dashboard.wiew',
        ];

        $coordinatorPermissions = [
            "calendar.edit",
            "calendar.list",
            "calendar.create",
            "calendar.show",

            "applications.list",
            "applications.all",
            "applications.create",
            "applications.edit",
            "applications.changeStaff",
            "applications.show",

            "applications.details",

            "patients.list",
            "patients.create",
            "patients.edit",
            "patients.details",
            "patients.show",

            "payments.list",
            "payments.create",
            "payments.edit",
            "payments.destroy",
            "payments.show",
            "payments.details",

            "patients.list",
            "patients.create",
            "patients.edit",
            "patients.destroy",
            "patients.details",
            "patients.show",

        ];

        $dios->givePermissionTo(Permission::all());
        $superAdmin->givePermissionTo(Permission::all());
        $doctor->givePermissionTo($doctorPermissions);
        $nurse->givePermissionTo($nursePermissions);
        $driver->givePermissionTo($driverPermissions);
        $admin->givePermissionTo($adminPermissions);
        $coordinator->givePermissionTo($coordinatorPermissions);

    }
}
