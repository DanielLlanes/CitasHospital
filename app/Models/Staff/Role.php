<?php

namespace App\Models\Staff;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Role extends Model
{
    use HasFactory;

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
