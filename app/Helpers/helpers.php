<?php

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

if (!function_exists('saludar')) {
    function saludar($hola = null) {
        if (!empty($hola)) {
            return $hola;
        }
    }
}

if (!function_exists('getAvatar')) {
    function getAvatar($user) {
        if (!is_null($user->load('imageOne')->imageOne)) {
            return $user->load('imageOne')->imageOne->image;
        } else {
            return "staffFiles/assets/img/user/user.jpg";
        }
    }
}

if (!function_exists('getBrandImage')) {
    function getBrandImage($brand) {
        if (!is_null($brand->load('imageOne')->imageOne)) {
            return $brand->load('imageOne')->imageOne->image;
        } else {
            $image = Str::of($brand->brand)->slug("-");
            return "/siteFiles/assets/img/brands/".$image.".jpg";
        }
    }
}

if (!function_exists('getTreamentImage')) {
    function getTreamentImage($treatment) {
        if (!is_null($treatment->load('imageOne')->imageOne)) {
            return $treatment->load('imageOne')->imageOne->image;
        } else {
            return "staffFiles/assets/img/treatment/no-image-available.jpeg";
        }
    }
}

if (!function_exists('getStatus')) {
    function getStatus($name, $color) {
        return '<span class="label label-sm text-capitalize" style="background-color: '.$color.'">'.ucwords(str_replace('_', ' ', $name)).'</span>';

    }
}

if (!function_exists('getCode')) {
    function getCode() {
        return time().uniqid(Str::random(30));
    }
}

if (!function_exists('getStracto')) {
    function getStracto($string, $char) {
        $countChar = strlen($string);
        if ($countChar <= $char) {
            return $string;
        }
        return substr($string, 0, $char)." ...";
    }
}

if (!function_exists('isRoleExist')) {
    function isRoleExist($role) {
        $x = Role::where('name', $role)->get();

        if (count($x) > 0) {return true;}
        return false;
    }
}

if (!function_exists('getUcWords')) {
    function getUcWords($string) {
        $string = strtolower($string);
        $string = ucwords($string);
        return $string;
    }
}

if (!function_exists('getAvatarChached')) {
    function getAvatarCached($user, $filter) {
        if (!is_null($user->load('imageOne')->imageOne)) {
            $fileName = $user->load('imageOne')->imageOne->image;
            return("imagecache/$filter/$fileName");
        } else {
            return "staffFiles/assets/img/user/user.jpg";
        }
    }
}

if (! function_exists('baseUrl')) {
    function baseUrl() {
        return config('app.base_url');
    }
}

if (! function_exists('staffUrl')) {
    function staffUrl() {
        return config('app.staff_subdomain') . '.' . baseUrl();
    }
}

if (! function_exists('partnersUrl')) {
    function partnersUrl() {
        return config('app.partners_subdomain') . '.' . baseUrl();
    }
}

if (! function_exists('apiUrl')) {
    function apiUrl() {
        return config('app.api_subdomain') . '.' . baseUrl();
    }
}

if (! function_exists('password')) {
    function password($length = 8)
    {
        if ($length < 6) { $length = 6;}
        $chars = "!@#$%^&*()_-=+;:,.?~`[]";
        $bc = base_convert(sha1(uniqid(mt_rand())), 16, 36);
        $tm = time();
        $all = $bc.$tm.$chars;
        $p = substr( str_shuffle( $all ), 0, $length );
        return $p;
    }
}

if (! function_exists('sugerencias')) {
    function sugerencias($sugerencia = [])
    {
        $segArray = [
            ['id' => 1, 'nombre' => 'MMO'],
            ['id' => 2, 'nombre' => 'EMMO'],
            ['id' => 3, 'nombre' => 'CMMO'],
            ['id' => 4, 'nombre' => 'TT'],
            ['id' => 5, 'nombre' => 'ETT'],
            ['id' => 6, 'nombre' => 'CCT'],
            ['id' => 7, 'nombre' => 'FDL'],
            ['id' => 8, 'nombre' => 'TORSO'],
            ['id' => 9, 'nombre' => 'AL'],
            ['id' => 10, 'nombre' => 'TL'],
            ['id' => 11, 'nombre' => 'BA'],
            ['id' => 12, 'nombre' => 'BLA'],
            ['id' => 13, 'nombre' => 'BR'],
            ['id' => 14, 'nombre' => 'LIPOSCULPTURE'],
            ['id' => 15, 'nombre' => 'LIPO 360 (lower back, sides, belly)'],
            ['id' => 16, 'nombre' => 'LIPO UPPER BACK'],
            ['id' => 17, 'nombre' => 'LIPO LOWER BACK'],
            ['id' => 18, 'nombre' => 'LIPO ARM'],
            ['id' => 19, 'nombre' => 'LIPO THIGH'],
            ['id' => 20, 'nombre' => 'LIPO BELLY'],
            ['id' => 21, 'nombre' => 'LIPO SIDES'],
            ['id' => 22, 'nombre' => 'LIPO CHIN'],
            ['id' => 23, 'nombre' => 'FL'],
            ['id' => 24, 'nombre' => 'NL'],
            ['id' => 25, 'nombre' => 'EYE LIFT'],
            ['id' => 26, 'nombre' => 'BLEFARO'],
            ['id' => 27, 'nombre' => 'RINO'],
            ['id' => 28, 'nombre' => 'MONTS LIFT'],
            ['id' => 29, 'nombre' => 'BACK LIFT'],
            ['id' => 30, 'nombre' => 'BICHAT'],
            ['id' => 31, 'nombre' => 'BROW LIFT'],
            ['id' => 32, 'nombre' => 'GINECOMASTIA'],
        ];





        if (empty($sugerencia)) {
            $collection = collect($segArray)->map(function ($item) {
                return (object) $item;
            });
             return $collection;
        } else {
               $array = [];
               foreach ($sugerencia as $key => $value) {
                   $valorBuscado = $value['nombre'];
                    foreach ($segArray as $elemento) {
                        if (in_array($valorBuscado, $elemento)) {
                            $array[] = [
                                'id' => $elemento['id'],
                                'nombre' => $elemento['nombre'],
                            ];
                        }
                    }
               }
            $collection = collect($array)->map(function ($item) {
                return (object) $item;
            });
             return $collection;
        }
    }
}