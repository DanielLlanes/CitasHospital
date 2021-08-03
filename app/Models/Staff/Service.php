<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withPivot('order');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
