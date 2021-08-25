<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

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

    public function exercices()
    {
        return $this->hasMany(ExerciseApplication::class);
    }
}
