<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function procedure()
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }
    public function treatment()
    {
        return $this->hasMany(Treatment::class);
    }

}
