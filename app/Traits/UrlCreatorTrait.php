<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UrlCreatorTrait {
    public function urlCreatorTrait($str)
    {
        //crear stract
        //$slug = Str::of($str)->slug("-")->limit(150 - mb_strlen($valorAleatorio) - 1, "")->trim("-")->append("-", $valorAleatorio);
        //Create url
        $slug = Str::of($str)->slug("-")->limit(50);
        $slug = Str::of($slug)->slug("-");
		return $slug;
    }

    public function stractCreatorTrait($text){


    }
}
