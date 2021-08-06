<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'brand' => 'a slimmer me',
            'acronym' => 'asm',
            'color' => '#a93226',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'asm',
        ]);
        Brand::create([
            'brand' => 'a beautiful me',
            'acronym' => 'abm',
            'color' => '#884ea0',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'abm',
        ]);
        Brand::create([
            'brand' => 'a better me',
            'acronym' => 'abtm',
            'color' => '#2471a3',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'abtm',
        ]);
        Brand::create([
            'brand' => 'a smiling me',
            'acronym' => 'aslm',
            'color' => '#1b4f72',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'aslm',
        ]);
        Brand::create([
            'brand' => 'a scope for me',
            'acronym' => 'aslm',
            'color' => '#17a589',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'aslm',
        ]);
        Brand::create([
            'brand' => 'a fixed me',
            'acronym' => 'afm',
            'color' => '#1ecac5',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'afm',
        ]);
        Brand::create([
            'brand' => 'labs',
            'acronym' => 'lab',
            'color' => '#ca6Ffe',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'lab',
        ]);

    }
}
