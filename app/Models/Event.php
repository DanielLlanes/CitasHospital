<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes; //Implementamos

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
