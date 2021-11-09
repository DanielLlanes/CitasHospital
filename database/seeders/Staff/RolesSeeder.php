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
            'assignable' => '0',
            'active' => false,
            'show' => false
        ]);

        $superAdmin = Role::create([
            'id' => 2,
            'name' => 'super-administrator',
            'guard_name' => 'staff',
            'name_es' => 'Super Administrador',
            'name_en' => 'Super Administrador',
            'assignable' => '0',
            'active' => false,
            'show' => false
        ]);

        $admin = Role::create([
            'id' => 3,
            'name' => 'administrator',
            'guard_name' => 'staff',
            'name_es' => 'Administrador',
            'name_en' => 'Administrator',
            'assignable' => '0',
        ]);

        $doctor = Role::create([
            'id' => 4,
            'name' => 'doctor',
            'guard_name' => 'staff',
            'name_es' => 'Doctor',
            'name_en' => 'Doctor',
            'assignable' => '0',
        ]);

        $nurse = Role::create([
            'id' => 5,
            'name' => 'nurse',
            'guard_name' => 'staff',
            'name_es' => 'Emfermero',
            'name_en' => 'Nurse',
            'assignable' => '0',
        ]);

        $coordinator = Role::create([
            'id' => 6,
            'name' => 'coordinator',
            'guard_name' => 'staff',
            'name_es' => 'Coordinador',
            'name_en' => 'Coordinator',
            'assignable' => '1',
        ]);

        $driver = Role::create([
            'id' => 7,
            'name' => 'driver',
            'guard_name' => 'staff',
            'name_es' => 'Chofer',
            'name_en' => 'Driver',
            'assignable' => '0',
        ]);

        $doctorPermissions = [
            "calendar.show",
            "calendar.list",
            "applications.list",
            "applications.show",
            "applications.details"
        ];

        $nursePermissions = [
            "applications.list",
            "applications.show",
            "applications.details",
            "calendar.show",
            "calendar.list",
        ];

        $driverPermissions = [
            "calendar.show",
            "calendar.list",
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
            "staff.create.permisions",
            "staff.edit.permisions",

            "staff.list.admins",
            "staff.create.admins",
            "staff.edit.admins",
            "staff.destroy.admins",
            "staff.activate.admins",
            "staff.show.admins",
            "staff.reset.password.admins",
            "staff.create.permisions.admins",
            "staff.edit.permisions.admins",

            "applications.list",
            "applications.details",
            "applications.create",
            "applications.edit",
            "applications.setprice",
            "applications.changeStaff",
            "applications.destroy",
            "applications.show",

            "patients.list",
            "patients.create",
            "patients.edit",
            "patients.destroy",
            "patients.details",
            "patients.show",

            "procedures.list",
            "procedures.create",
            "procedures.edit",
            "procedures.destroy",
            "procedures.activate",

            "payments.list",
            "payments.create",
            "payments.edit",
            "payments.destroy",
            "payments.show",

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
            "applications.details",
            "applications.create",
            "applications.edit",
            "applications.changeStaff",
            "applications.show",
            "patients.list",
            "patients.create",
            "patients.edit",
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
