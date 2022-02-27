<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

class Specialty extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at'];

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
        return $this->belongsToMany(Staff::class);
    }

}
