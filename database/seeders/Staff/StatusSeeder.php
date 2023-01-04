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
                "name_es" => "En espera",//
                'color' => "#fdcae1",
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Debate",
                "name_es" => "Debate",
                'color' => "#84b6f4",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Declined",
                "name_es" => "Declinada",
                'color' => "#ff6961",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Second opinion",
                "name_es" => "Segunda opinión",
                'color' => "#bc98f3",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Accepted",
                "name_es" => "Aceptada",//
                'color' => "#77dd77",
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Scheduled",
                "name_es" => "Agendada",
                'color' => "#0074A2",
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "In surgery",
                "name_es" => "En cirugía",
                'color' => "#c7f7f7",
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Finished",
                "name_es" => "Finalizada",
                'color' => "#a2a0a1",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "New",
                "name_es" => "Nueva",
                'color' => "#c0a0c3",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Cancelled",
                "name_es" => "Cancelada",
                'color' => "#e8212e",
                "type" => 'Event',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Postponed",
                "name_es" => "Pospuesta",
                'color' => "#c9158c",//
                "type" => 'Event',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Evaluations",
                "name_es" => "Valoraciones",
                'color' => "#fadd41",//
                "type" => 'Event',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Cambio de procedimiento",
                "name_es" => "Change of procedure",
                'color' => "#f73b31",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Accepted unassigned",
                "name_es" => "Aceptada sin asignar",
                'color' => "#faa05f",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                "name_en" => "Con sugerencias",
                "name_es" => "With suggestions",
                'color' => "#d9c250",//
                "type" => 'Application',
                'code' => time().uniqid(Str::random(30)),
            ],
        ]);
    }

    #INSERT INTO `statuses`(`name_en`, `name_es`, `color`, `code`, `type` ) VALUES ('With suggestions','Con sugerencias','#d9c250','1672558163EO91sO1b7xGPclLt2gTWQpgYQeJ4mB63b136531faa1','Application');
}
