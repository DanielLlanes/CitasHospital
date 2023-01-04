<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;


    protected $fillable = ['application_id', 'staff_id', 'procedure_id', 'code'];
    protected $dates = ['deleted_at'];
}
