<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use App\Notifications\StaffResetPasswordNotification as StaffResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes; //Implementamos


    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna




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
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StaffResetPasswordNotification($token));
    }
    public function workhistory()
    {
        return $this->hasMany(WorkHistoryStaff::class);
    }
    public function surgeryperformed()
    {
        return $this->hasMany(SurgeryPerformedStaff::class);
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
    public function debate_staff()
    {
        return $this->hasMany(Debate::class);
    }
    public function imageOne()
    {
        return $this->morphOne(ImageOne::class, 'imageOneable');
    }
    public function imageMany()
    {
        return $this->morphMany(ImageMany::class, 'imageManyable');
    }
    public function staff_message()
    {
        return $this->hasMany(Message::class, 'staff_id');
    }
}
