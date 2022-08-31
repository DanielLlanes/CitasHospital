<?php

namespace App\Models\Partners;

use App\Models\Site\Application;
use App\Models\Staff\ImageOne;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Partner extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes; //Implementamos

    public $timestamps = true;

    protected $fillable = ['code', 'application_id', 'partner_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function imageOne()
    {
        return $this->morphOne(ImageOne::class, 'imageOneable');
    }
    public function applications()
    {
        return $this->belongsToMany(Application::class);
    }

}
