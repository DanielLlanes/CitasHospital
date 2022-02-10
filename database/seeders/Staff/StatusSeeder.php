<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                "name_en" => "Waiting",
                "name_es" => "En espera",
                "description_en" => "New application",
                "description_es" => "Aplicación nueva",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Debate",
                "name_es" => "Debate",
                "description_en" => "Application in debate",
                "description_es" => "Aplicación en debate",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Declined",
                "name_es" => "Declinada",
                "description_en" => "Declined Application",
                "description_es" => "Aplicación declinada",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Second opinion",
                "name_es" => "Segunda opinión",
                "description_en" => "Second_opinded",
                "description_es" => "Segunda opinión",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Accepted",
                "name_es" => "Aceptada",
                "description_en" => "Application accepted",
                "description_es" => "Aplicación aceptada",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Scheduled",
                "name_es" => "Agendada",
                "description_en" => "Scheduled application",
                "description_es" => "Aplicación agendada",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "In surgery",
                "name_es" => "En cirugía",
                "description_en" => "Application in surgery",
                "description_es" => "Aplicación en cirugía",
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Finished",
                "name_es" => "Finalizada",
                "description_en" => "Finished application",
                "description_es" => "Aplicación finalizada",
                'code' => time().uniqid(Str::random(30)),
            ]
        ]);
    }
}
