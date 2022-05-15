<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function imageOne()
    {
        return $this->morphOne(ImageOne::class, 'imageOneable');
    }
    public function videoOne()
    {
        return $this->morphOne(VideoOne::class, 'videoOneable');
    }
}
