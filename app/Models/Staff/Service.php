<?php

namespace App\Models\Staff;

use App\Models\Staff\Specialty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }
    public function seviceAssignedTo()
    {
        return $this->belongsToMany(Staff::class)->withTimestamps();
    }
    public function descriptionone()
    {
        return $this->morphOne(DescriptionOne::class, 'descriptionOneable');
    }
    public function specialty()
    {
        return $this->belongsTo(Service::class);
    }

}
