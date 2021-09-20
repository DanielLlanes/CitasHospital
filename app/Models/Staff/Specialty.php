<?php

namespace App\Models\Staff;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialty extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('order')->withTimestamps();
    }
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

}
