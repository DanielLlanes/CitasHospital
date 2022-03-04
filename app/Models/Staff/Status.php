<?php

namespace App\Models\Staff;


use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['status_id','indications','recomendations','reason','code'];


}
