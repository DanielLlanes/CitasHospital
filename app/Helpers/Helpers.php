<?php

if (! function_exists('saludar')) {
    function saludar($hola = null) {
        if (!empty($hola)) {
            return $hola;
        }
    }
}
