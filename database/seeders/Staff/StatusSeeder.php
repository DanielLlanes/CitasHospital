<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ],
            [
                "name_en" => "Debate",
                "name_es" => "Debate",
                "description_en" => "Application in debate",
                "description_es" => "Aplicación en debate",
            ],
            [
                "name_en" => "Declined",
                "name_es" => "Declinada",
                "description_en" => "Declined Application",
                "description_es" => "Aplicación declinada",
            ],
            [
                "name_en" => "Second opinion",
                "name_es" => "Segunda opinión",
                "description_en" => "Second_opinded",
                "description_es" => "Segunda opinión",
            ],
            [
                "name_en" => "Accepted",
                "name_es" => "Aceptada",
                "description_en" => "Application accepted",
                "description_es" => "Aplicación aceptada",
            ],
            [
                "name_en" => "Scheduled",
                "name_es" => "Agendada",
                "description_en" => "Scheduled application",
                "description_es" => "Aplicación agendada",
            ],
            [
                "name_en" => "In surgery",
                "name_es" => "En cirugía",
                "description_en" => "Application in surgery",
                "description_es" => "Aplicación en cirugía",
            ],
            [
                "name_en" => "Finished",
                "name_es" => "Finalizada",
                "description_en" => "Finished application",
                "description_es" => "Aplicación finalizada",
            ]
        ]);
    }
}
