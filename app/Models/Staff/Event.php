<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes; //Implementamos

    public $timestamps = true;

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
