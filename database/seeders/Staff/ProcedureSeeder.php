<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedures')->insert([
            [
                'id' => 1,
                'procedure_es' => 'Manga Gástrica',
                'procedure_en' => 'Gastric Sleeve',
                'description_es' => 'Este es el tratamiento estándar de oro para la obesidad en el mundo. Con esta operación, el cirujano extirpa entre 70 a 80% del estómago dejando el resto en forma de tubo o manga.',
                'description_en' => 'This is the gold standard treatment for obesity in the world. With this operation, the surgeon removes between 70 to 80% of the stomach leaving the rest in the form of a tube or sleeve.',
                'service_id' => '1',
                'has_package' => true
            ],
            [
                'id' => 2,
                'procedure_es' => 'Revisión',
                'procedure_en' => 'Revision',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '1',
                'has_package' => true
            ],
            [
                'id' => 3,
                'procedure_es' => 'Bypass Gástrico Roux-en-Y (RNY)',
                'procedure_en' => 'Bypass any',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '1',
                'has_package' => true
            ],
            [
                'id' => 4,
                'procedure_es' => 'Bypass Gástrico de una Anastomosis (Bagua)',
                'procedure_en' => 'Mini Bypass (Bagua)',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '1',
                'has_package' => true
            ],
            [
                'id' => 5,
                'procedure_es' => 'Sadis',
                'procedure_en' => 'Sadis',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '1',
                'has_package' => true
            ],
            [
                'id' => 6,
                'procedure_es' => 'Cruce duodenal',
                'procedure_en' => 'Duodenal swith',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '1',
                'has_package' => true
            ],
            /////
            [
                'id' => 7,
                'procedure_es' => 'Tummy Truck (Abdominoplastia)',
                'procedure_en' => 'Tummy Truck (Abdominopasty)',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 8,
                'procedure_es' => 'Lipoescultura',
                'procedure_en' => 'Liposculpture',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 9,
                'procedure_es' => 'Aumento de senos',
                'procedure_en' => 'Breast augmentation',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 10,
                'procedure_es' => 'Reducción de senos',
                'procedure_en' => 'Breast lift',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 11,
                'procedure_es' => 'Levantamiento de glúteos brasileño',
                'procedure_en' => 'Braziliand Butt lift',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 12,
                'procedure_es' => 'Levantamiento de brazos',
                'procedure_en' => 'Arm lift',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 13,
                'procedure_es' => 'Levantamiento de muslos',
                'procedure_en' => 'Thinght lift',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 14,
                'procedure_es' => 'Estiramiento facial',
                'procedure_en' => 'Face lift',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 15,
                'procedure_es' => 'Blefaroplastia',
                'procedure_en' => 'Blepharoplasty',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 16,
                'procedure_es' => 'Rinoplastia',
                'procedure_en' => 'Rhinoplasty',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 17,
                'procedure_es' => 'Mommy Makeover',
                'procedure_en' => 'Mommy Makeover',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '2',
                'has_package' => false
            ],
            [
                'id' => 18,
                'procedure_es' => 'Disfunción eréctil con PRP',
                'procedure_en' => 'Erectile disfuction with PRP',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 19,
                'procedure_es' => 'Terapia de regeneración vascular',
                'procedure_en' => 'Vascular regeneration therapy',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 20,
                'procedure_es' => 'Tratamiento farmacológico',
                'procedure_en' => 'Pharmacological treatment',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 21,
                'procedure_es' => 'Prótesis de pene',
                'procedure_en' => 'Penile prosthesis',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 22,
                'procedure_es' => 'Cirugía láser de luz verde',
                'procedure_en' => 'Green light laser surgery',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 23,
                'procedure_es' => 'Reversión de vasectomía',
                'procedure_en' => 'Revelsar of vasectomy',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 24,
                'procedure_es' => 'Cirugía de incontinencia urinaria femenina',
                'procedure_en' => 'Urinary incontinence sergery (women)',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '3',
                'has_package' => false
            ],
            [
                'id' => 25,
                'procedure_es' => 'Rellenos',
                'procedure_en' => 'fillings',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 26,
                'procedure_es' => 'Coronas / Carillas',
                'procedure_en' => 'Crowns/ veneers',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 27,
                'procedure_es' => 'Dentaduras',
                'procedure_en' => 'Dentures',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 28,
                'procedure_es' => 'Tratamiento de conducto',
                'procedure_en' => 'Root canal treatment',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 29,
                'procedure_es' => 'Limpieza',
                'procedure_en' => 'cleaning',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 30,
                'procedure_es' => 'Blanqueamiento',
                'procedure_en' => 'Whitering',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 31,
                'procedure_es' => 'Extracciones',
                'procedure_en' => 'Extractions',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
            [
                'id' => 32,
                'procedure_es' => 'Implantes',
                'procedure_en' => 'Implants',
                'description_es' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,.',
                'description_en' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim culpa repellat ipsam quis. Explicabo ad,..',
                'service_id' => '4',
                'has_package' => false
            ],
        ]);
    }
}
