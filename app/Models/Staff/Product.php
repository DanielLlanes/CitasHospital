<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);

    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
