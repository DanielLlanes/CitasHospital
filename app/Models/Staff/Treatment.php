<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
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
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function imageOne()
    {
        return $this->morphOne(ImageOne::class, 'imageOneable');
    }
    public function contains()
    {
        return $this->morphMany(Contain::class, 'containable');
    }
}
