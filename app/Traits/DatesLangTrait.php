<?php

namespace App\Traits;

trait DatesLangTrait {
    public function datesLangTrait ($date, $lang)
    {
        $date = substr($date, 0, 10);
        $dia = date('l', strtotime($date));
        $mes = date('F', strtotime($date));
        $anio = date('Y', strtotime($date));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");


        switch ($lang) {

            case 'es':
                $numeroDia = date('j', strtotime($date));
                $nombredia = str_replace($dias_EN, $dias_ES, $dia);
                $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
                return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
            break;

            default:
            $numeroDia = date('jS', strtotime($date));
            $nombredia = str_replace($dias_ES, $dias_EN, $dia);
            $nombreMes = str_replace($meses_ES, $meses_EN, $mes);
            return $nombredia.", ".$nombreMes." ".$numeroDia.", ".$anio;

        }
    }
}
Class DatesLangTraitForBlade
{
    use DatesLangTrait;
}
