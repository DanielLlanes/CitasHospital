<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna


    public function service()
    {
        return $this->hasOne(Service::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
