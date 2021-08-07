<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ],
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
            ],
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
            ],
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
            ],
            [
                'id' => '7',
                'brand_id' => '7',
				'service_en' => 'Blood Work',
				'service_es' => 'análisis de sangre',
                'need_images' => false,
                'qty_images' => 0,
                'description_en' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description_es' => 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'url' => 'blood-work',
            ],
        ]);
        DB::table('service_specialty')->insert([
            [
                'service_id' => 1,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 1,
                'specialty_id' => 6,
                'order' => 2,
            ],
            [
                'service_id' => 1,
                'specialty_id' => 6,
                'order' => 3,
            ],
            [
                'service_id' => 1,
                'specialty_id' => 5,
                'order' => 4,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 5,
                'order' => 2,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 8,
                'order' => 3,
            ],
            [
                'service_id' => 2,
                'specialty_id' => 8,
                'order' => 4,
            ],
            [
                'service_id' => 3,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 3,
                'specialty_id' => 7,
                'order' => 2,
            ],
            [
                'service_id' => 4,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 4,
                'specialty_id' => 4,
                'order' => 2,
            ],
            [
                'service_id' => 5,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 5,
                'specialty_id' => 12,
                'order' => 2,
            ],
            [
                'service_id' => 6,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 6,
                'specialty_id' => 13,
                'order' => 2,
            ],
            [
                'service_id' => 7,
                'specialty_id' => 10,
                'order' => 1,
            ],
            [
                'service_id' => 7,
                'specialty_id' => 14,
                'order' => 2,
            ],
        ]);
    }
}
