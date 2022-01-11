<?php

namespace App\Models\Staff;


use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function status_apps()
    {
        return $this->belongsToMany(Application::class);
    }
}
