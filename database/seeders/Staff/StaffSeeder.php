<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dios = Staff::create([
                'name' => 'Gabriel Llanes',
                'username' => 'gabriel',
                'cellphone' => '6645335213',
                'phone' => '6642104318',
                'email' => 'tejeda.llanes@gmail.com',
                'password' => Hash::make('22Diciembre'),
                'lang' => 'en',
                'avatar' => "staffFiles/assets/img/user/user.jpg",
                'show' => false,
                'set_pass' => true,
                'color' => '#1596fb',
                'specialty_id' => '1',
                'remember_token' => Str::random(10),
        ]);

        $admin = Staff::create([

                'name' => 'Super Admin',
                'username' => 'admin',
                'cellphone' => '+199222356',
                'phone' => '+199222356',
                'email' => 'administrador@jlprado.com',
                'password' => Hash::make('sistema123'),
                'lang' => 'en',
                'avatar' => "staffFiles/assets/img/user/user.jpg",
                'set_pass' => true,
                'specialty_id' => '2',
                'remember_token' => Str::random(10),
                'show' => false,
                'color' => '#ff5733',
        ]);

        $janlu = Staff::create([

                'name' => 'Janlu Prado',
                'username' => 'janlu',
                'cellphone' => '+199222356',
                'phone' => '+199222356',
                'email' => 'janluprado@gmail.com',
                'password' => Hash::make('secret'),
                'lang' => 'en',
                'avatar' => "staffFiles/assets/img/user/user.jpg",
                'set_pass' => false,
                'specialty_id' => '3',
                'remember_token' => Str::random(10),
                'show' => true,
                'color' => '#3393ff',
        ]);

        $ismael = Staff::create([
                'name' => 'Ismael Hernandez',
                'username' => 'ismael',
                'cellphone' => '+199222356',
                'phone' => '+199222356',
                'email' => 'facturacion@jlpradosc.com',
                'password' => Hash::make('secret'),
                'lang' => 'en',
                'avatar' => "staffFiles/assets/img/user/user.jpg",
                'set_pass' => false,
                'specialty_id' => '3',
                'show' => true,
                'color' => '#f29f2c',
                'remember_token' => Str::random(10),
        ]);

        $adminRole = [
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
            "patient.show",

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
        ];

        $dios->assignRole('dios');
        $admin->assignRole('super-administrator');
        $janlu->assignRole('administrator');
        $ismael->assignRole('administrator');

        $janlu->givePermissionTo($adminRole);
        $ismael->givePermissionTo($adminRole);
    }
}
