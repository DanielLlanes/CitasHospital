<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

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
                'lang' => 'es',

                'show' => false,
                'set_pass' => true,
                'color' => '#1596fb',
                'url' => 'gabriel-llanes',
                'remember_token' => Str::random(10),
                'code' => time().uniqid(Str::random(30)),
        ]);

        $admin = Staff::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'cellphone' => '+199222356',
            'phone' => '+199222356',
            'email' => 'administrador@jlprado.com',
            'password' => Hash::make('sistema123'),
            'lang' => 'es',
            'set_pass' => true,
            'show' => false,
            'color' => '#ff5733',
            'url' => 'super-admin',
            'remember_token' => Str::random(10),
            'code' => time().uniqid(Str::random(30)),
        ]);

        $janlu = Staff::create([
            'name' => 'Janlu Prado',
            'username' => 'janlu',
            'cellphone' => '+199222356',
            'phone' => '+199222356',
            'email' => 'janluprado@gmail.com',
            'password' => Hash::make('secret'),
            'lang' => 'es',
            'set_pass' => false,
            'show' => true,
            'color' => '#3393ff',
            'url' => 'janlu-prado',
            'remember_token' => Str::random(10),
            'code' => time().uniqid(Str::random(30)),
        ]);

        $ismael = Staff::create([
            'name' => 'Ismael Hernandez',
            'username' => 'ismael',
            'cellphone' => '+199222356',
            'phone' => '+199222356',
            'email' => 'facturacion@jlpradosc.com',
            'password' => Hash::make('secret'),
            'lang' => 'es',
            'set_pass' => false,
            'show' => true,
            'color' => '#f29f2c',
            'url' => 'ismael-hernandez',
            'remember_token' => Str::random(10),
            'code' => time().uniqid(Str::random(30)),
        ]);

        $dios->assignRole('dios');
        $admin->assignRole('super-administrator');
        $janlu->assignRole('administrator');
        $ismael->assignRole('administrator');

        DB::table('specialty_staff')->insert([
            'specialty_id' => 1,
            'staff_id' => $dios->id,
            'code' => time().uniqid(Str::random(30)),
        ]);
        DB::table('specialty_staff')->insert([
            'specialty_id' => 2,
            'staff_id' => $admin->id,
            'code' => time().uniqid(Str::random(30)),
        ]);
        DB::table('specialty_staff')->insert([
            'specialty_id' => 3,
            'staff_id' => $janlu->id,
            'code' => time().uniqid(Str::random(30)),
        ]);
        DB::table('specialty_staff')->insert([
            'specialty_id' => 3,
            'staff_id' => $ismael->id,
            'code' => time().uniqid(Str::random(30)),
        ]);
    }
}
