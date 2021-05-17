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
                'username' => 'dios',
                'cellphone' => '6645335213',
                'phone' => '6642104318',
                'email' => 'tejeda.llanes@gmail.com',
                'password' => Hash::make('@@ModoDios'),
                'lang' => 'en',
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
                'set_pass' => true,
                'specialty_id' => '2',
                'remember_token' => Str::random(10),
                'active' => true,
                'show' => true,
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
                'set_pass' => false,
                'specialty_id' => '2',
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
                'set_pass' => false,
                'specialty_id' => '2',
                'active' => true,
                'show' => true,
                'color' => '#F7F083',
                'remember_token' => Str::random(10),
        ]);
        $dios->assignRole('dios');
        $admin->assignRole('administrator');
        $janlu->assignRole('administrator');
        $ismael->assignRole('administrator');
    }
}
