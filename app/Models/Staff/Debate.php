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

    
    public function applicationsDebate()
    {
        return $this->belongsTo(Application::class);
    }
    public function staffDebate()
    {
        return $this->belongsTo(Staff::class, "staff_id");
    }
    public function message()
    {
        return $this->morphOne(Message::class, 'messageable');
    }
}
