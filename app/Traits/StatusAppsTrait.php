<?php

namespace App\Traits;

trait StatusAppsTrait {
    public function statusAppTrait($status)
    {

        switch ($status) {

            case 'waiting':
            return '<span class="label label-sm status-waiting">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'denied':
            return '<span class="label label-sm status-denied">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'debate':
            return '<span class="label label-sm status-debate">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'second_opinion':
            return '<span class="label label-sm status-second_opinion">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'accepted':
            return '<span class="label label-sm status-accepted">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'scheduled':
            return '<span class="label label-sm status-scheduled">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'in_surgery':
            return '<span class="label label-sm status-in_surgery">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            case 'finalized':
            return '<span class="label label-sm status-finalized">'.ucwords(str_replace('_', ' ', $status)).'</span>';
            break;

            default:
            echo '$variable no es igual a 1, 2 o 3.';

        }
    }
}
