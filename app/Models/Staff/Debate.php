<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debate extends Model
{
    use HasFactory;
    use SoftDeletes; //Implementamos

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    
    public function applications_debate()
    {
        return $this->belongsTo(Application::class);
    }
    public function staff_debate()
    {
        return $this->belongsTo(Staff::class, "staff_id");
    }
}
