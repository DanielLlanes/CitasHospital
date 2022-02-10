<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostgraduateStudiesStaff extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
