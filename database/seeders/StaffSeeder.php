<?php

namespace Database\Seeders;

use App\Models\Staff;
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
                'active' => true,
                'show' => false,
                'set_pass' => true,
                'color' => '#1596FB',
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
                'active' => true,
                'show' => false,
                'color' => '#FF5733',
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
                'active' => true,
                'show' => true,
                'color' => '#3393FF',
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
                'active' => true,
                'show' => true,
                'color' => '#f29f2c',
                'remember_token' => Str::random(10),
        ]);

        $adminRole = [
            "calendar.edit",
            "calendar.list",
            "calendar.create",
            "calendar.destroy",

            "staff.list",
            "staff.create",
            "staff.edit",
            "staff.destroy",
            "staff.destroy.admins",
            "staff.activate",
            'staff.edit.admins',

            "applications.list",
            "applications.details",
            "applications.create",
            "applications.edit",
            "applications.setprice",
            "applications.changeStaff",
            "applications.destroy",

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
            "services.destroy",

            "packages.list",
            "packages.create",
            "packages.edit",
            "packages.destroy",
        ];

        $dios->assignRole('dios');
        $admin->assignRole('super-administrator');
        $janlu->assignRole('administrator');
        $ismael->assignRole('administrator');

        $janlu->givePermissionTo($adminRole);
        $ismael->givePermissionTo($adminRole);
    }
}
