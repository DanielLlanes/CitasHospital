<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use App\Models\Staff\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes; //Implementamos

    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function statusOne()
    {
        return $this->morphOne(StatusOne::class, 'statusOneable');
    }
}
