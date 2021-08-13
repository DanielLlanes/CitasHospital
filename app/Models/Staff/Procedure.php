<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('order', 'price');

    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
