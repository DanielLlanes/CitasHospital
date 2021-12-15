<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
