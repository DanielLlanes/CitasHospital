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
            'image' => 'siteFiles/assets/img/brands/image/a_slimmer_me.jpg',
            'brand' => 'a slimmer me',
            'acronym' => 'asm',
            'color' => '#a93226',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a-slimmer-me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/a_beautiful_me.jpg',
            'brand' => 'a beautiful me',
            'acronym' => 'abm',
            'color' => '#884ea0',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a-beautiful-me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/a_better_me.jpg',
            'brand' => 'a better me',
            'acronym' => 'abtm',
            'color' => '#2471a3',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a-better-me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/a_smiling_me.jpg',
            'brand' => 'a smiling me',
            'acronym' => 'aslm',
            'color' => '#1b4f72',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a_smiling_me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/a_scope_for_me.jpg',
            'brand' => 'a scope for me',
            'acronym' => 'asfm',
            'color' => '#17a589',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a-scope-for-me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/a_fixed_me.jpg',
            'brand' => 'a fixed me',
            'acronym' => 'afm',
            'color' => '#1ecac5',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a-fixed-me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/a_healed_me.jpg',
            'brand' => 'a healed me',
            'acronym' => 'lab',
            'color' => '#ca6Ffe',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'a-healed-me',
        ]);
        Brand::create([
            'image' => 'siteFiles/assets/img/brands/image/labs.jpg',
            'brand' => 'labs',
            'acronym' => 'lab',
            'color' => '#ca6Ffe',
            'description_en' => 'Brand description',
            'description_es' => 'Descripcion de la marca',
            'url' => 'labs',
        ]);

    }
}
