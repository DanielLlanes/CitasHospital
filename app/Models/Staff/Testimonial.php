<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function imageOne()
    {
        return $this->morphOne(ImageOne::class, 'imageOneable');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
