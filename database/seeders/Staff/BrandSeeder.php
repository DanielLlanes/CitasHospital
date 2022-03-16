<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'color' => '#f15a29',
            'url' => 'a-slimmer-me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'a beautiful me',
            'acronym' => 'abm',
            'color' => '#006838',
            'url' => 'a-beautiful-me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'a better me',
            'acronym' => 'abtm',
            'color' => '#2b3990',
            'url' => 'a-better-me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'a smiling me',
            'acronym' => 'aslm',
            'color' => '#939598',
            'url' => 'a_smiling_me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'a scope for me',
            'acronym' => 'asfm',
            'color' => '#00a79d',
            'url' => 'a-scope-for-me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'a fixed me',
            'acronym' => 'afm',
            'color' => '#be1e1d',
            'url' => 'a-fixed-me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'a healed me',
            'acronym' => 'lab',
            'color' => '#a97c50',
            'url' => 'a-healed-me',
            'code' => time().uniqid(Str::random(30)),
        ]);
        Brand::create([
            'brand' => 'labs',
            'acronym' => 'lab',
            'color' => '#f7397f',
            'url' => 'labs',
            'code' => time().uniqid(Str::random(30)),
        ]);
    }
}
