<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('order', 'price')->withTimestamps();

    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function treatment()
    {
        return $this->hasMany(Treatment::class);
    }
    public function assignedTo()
    {
        return $this->belongsToMany(Staff::class)->withPivot('order')->withTimestamps();
    }
    public function descriptionone()
    {
        return $this->morphOne(DescriptionOne::class, 'descriptionOneable');
    }
}
