<?php

if (!function_exists('saludar')) {
    function saludar($hola = null) {
        if (!empty($hola)) {
            return $hola;
        }
    }
}

if (!function_exists('avatar')) {
    function avatar() {
        if (!is_null(auth()->guard('staff')->user()->load('imageOne')->imageOne)) {
            return auth()->guard('staff')->user()->load('imageOne')->imageOne->image;
        } else {
            return "staffFiles/assets/img/user/user.jpg";
        }
    }
}