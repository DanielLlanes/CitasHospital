<?php

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