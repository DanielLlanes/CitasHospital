<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalEmail extends Model
{
    use HasFactory;


    public function emailable()
    {
        return $this->morphTo();
    }

    // public function additional_assignable()
    // {
    //     return $this->morphedByMany(Assignment::class);
    // }
}
