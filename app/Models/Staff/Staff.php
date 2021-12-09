<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\StaffResetPasswordNotification as StaffResetPasswordNotification;

class Staff extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes; //Implementamos

    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'cellphone',
        'phone',
        'email',
        'password',
        'lang',
        'avatar',
        'active',
        'show',
        'set_pass',
        'color',
        'specialty_id',
        'last_assignment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function assignment()
    {
        return $this->belongsToMany(Application::class)->withPivot('ass_as');
    }

    public function assignToService()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
    public function assignToSpecialty()
    {
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StaffResetPasswordNotification($token));
    }
    public function workhistory()
    {
        return $this->hasMany(WorkHistoryStaff::class);
    }
    public function educationbackground()
    {
        return $this->hasMany(EducationBackgroundStaff::class);
    }
    public function postgraduatestudies()
    {
        return $this->hasMany(PostgraduateStudiesStaff::class);
    }
    public function updatecourses()
    {
        return $this->hasMany(UpdateCourseStaff::class);
    }
    public function careerobjetive()
    {
        return $this->hasMany(CareerObjetiveStaff::class);
    }
    public function imagespublicprofile()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = staff_id, localKey = id)
        return $this->hasMany(ImageProfileStaff::class);
    }
}
