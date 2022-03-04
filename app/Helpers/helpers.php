<?php

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