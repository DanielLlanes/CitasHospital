<?php

namespace App\Traits;

trait StatusAppsTrait {
    public function statusAppTrait($status)
    {

        switch ($status) {

            case 'Waiting':
            return '<span class="label label-sm status-waiting">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'En espera':
            return '<span class="label label-sm status-waiting">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Declined':
            return '<span class="label label-sm status-denied">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Declinada':
            return '<span class="label label-sm status-denied">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Debate':
            return '<span class="label label-sm status-debate">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Second opinion':
            return '<span class="label label-sm status-second_opinion">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Segunda opinión':
            return '<span class="label label-sm status-second_opinion">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Accepted':
            return '<span class="label label-sm status-accepted">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Aceptada':
            return '<span class="label label-sm status-accepted">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Scheduled':
            return '<span class="label label-sm status-scheduled">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Agendada':
            return '<span class="label label-sm status-scheduled">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'in surgery':
            return '<span class="label label-sm status-in_surgery">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'En cirugía':
            return '<span class="label label-sm status-in_surgery">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Finished':
            return '<span class="label label-sm status-finalized">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'Finalizada':
            return '<span class="label label-sm status-finalized">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            default:
            echo '$variable no es igual a 1, 2 o 3.';

        }
    }
}
Class StatusAppsTraitForBlade
{
    use StatusAppsTrait;
}
