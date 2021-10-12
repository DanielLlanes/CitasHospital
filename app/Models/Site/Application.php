<?php

namespace App\Models\Site;

use App\Models\Staff\Staff;
use App\Models\Staff\Patient;
use App\Models\Staff\Product;
use App\Models\Staff\Treatment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    public $timestamps = true;

    public function images()
    {
        return $this->hasMany(ImageApplication::class);
    }

    public function medications()
    {
        return $this->hasMany(MedicationApplication::class);
    }

    public function surgeries()
    {
        return $this->hasMany(SurgeryApplication::class);
    }

    public function illnessess()
    {
        return $this->hasMany(IllnsessApplication::class);
    }

    public function hormones()
    {
        return $this->hasMany(HormonesApplication::class);
    }
    public function birthcontrol()
    {
        return $this->hasMany(BirthControlApplication::class);
    }
    public function exercices()
    {
        return $this->hasMany(ExerciseApplication::class);
    }
    public function assignments()
    {
        return $this->belongsToMany(Staff::class)->withPivot('order');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
