<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurgeryPerformedStaff extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
