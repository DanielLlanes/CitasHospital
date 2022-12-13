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
        ]);
    }

    #INSERT INTO `statuses`(`name_en`, `name_es`, `color`, `code`, `type` ) VALUES ('Cambio de procedimiento','Change of procedure','#f73b31','1661809714L71jPIDOjzcTW9HOFYVbvxNFNlD4PB630d341234567','Application');
}
