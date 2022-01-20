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