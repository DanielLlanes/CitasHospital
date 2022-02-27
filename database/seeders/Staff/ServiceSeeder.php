<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'id' => '1',
                'brand_id' => '1',
				'service_en' => 'Bariatric Surgery',
				'service_es' => 'Cirugía Bariátrica',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'bariatric-surgey',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                'id' => '2',
                'brand_id' => '2',
				'service_en' => 'Plastic Surgery',
				'service_es' => 'Cirugía Plástica',
                'need_images' => true,
                'qty_images' => 4,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'plastic-surgey',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
				'id' => '3',
                'brand_id' => '3',
				'service_en' => 'Urology',
				'service_es' => 'Urología',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'urology',

            'code' => time().uniqid(Str::random(30)),            ],
            [
                'id' => '4',
                'brand_id' => '4',
				'service_es' => 'Dental',
				'service_en' => 'Dental',
                'need_images' => true,
                'qty_images' => 5,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'dental',

            'code' => time().uniqid(Str::random(30)),            ],
            [
                'id' => '5',
                'brand_id' => '5',
                'service_en' => 'Endoscopy',
				'service_es' => 'Endoscopia',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'endoscopy',

            'code' => time().uniqid(Str::random(30)),            ],
            [
                'id' => '6',
                'brand_id' => '6',
				'service_en' => 'Traumatology',
				'service_es' => 'Traumatología',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'traumatology',

            'code' => time().uniqid(Str::random(30)),            ],
            [
                'id' => '7',
                'brand_id' => '7',
				'service_en' => 'General Surgery',
				'service_es' => 'Cirugia General',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'General-Surgery',
                'code' => time().uniqid(Str::random(30)),
            ],
            [
                'id' => '8',
                'brand_id' => '8',
				'service_en' => 'Blood Work',
				'service_es' => 'Análisis de Sangre',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'blood-work',
                'code' => time().uniqid(Str::random(30)),
            ],
        ]);
        DB::table('service_specialty')->insert([
            [
                'service_id' => 1,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 1,
                'specialty_id' => 6,
            ],
            [
                'service_id' => 1,
                'specialty_id' => 5,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 5,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 8,
            ],
            [
                'service_id' => 3,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 3,
                'specialty_id' => 7,
            ],
            [
                'service_id' => 4,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 4,
                'specialty_id' => 4,
            ],
            [
                'service_id' => 5,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 5,
                'specialty_id' => 12,
            ],
            [
                'service_id' => 6,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 6,
                'specialty_id' => 13,
            ],
            [
                'service_id' => 7,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 7,
                'specialty_id' => 14,
            ],
            [
                'service_id' => 8,
                'specialty_id' => 10,
            ],
            [
                'service_id' => 8,
                'specialty_id' => 15,
            ],
        ]);
    }
}
