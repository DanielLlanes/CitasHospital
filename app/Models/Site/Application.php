<?php

namespace App\Models\Site;

use App\Models\Partners\Partner;
use App\Models\Staff\Debate;
use App\Models\Staff\ImageMany;
use App\Models\Staff\Notification;
use App\Models\Staff\Patient;
use App\Models\Staff\Payment;
use App\Models\Staff\Procedure;
use App\Models\Staff\Product;
use App\Models\Staff\Staff;
use App\Models\Staff\Status;
use App\Models\Staff\StatusOne;
use App\Models\Staff\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function images()
    {
        return $this->hasMany(ImageApplication::class);
    }
    public function imageMany()
    {
        return $this->morphMany(ImageMany::class, 'imageManyable');
    }
    public function medications()
    {
        return $this->hasMany(MedicationApplication::class);
    }
    public function surgeries()
    {
        return $this->hasMany(SurgeryApplication::class);
    }
    public function illnessess()
    {
        return $this->hasMany(IllnsessApplication::class);
    }
    public function hormones()
    {
        return $this->hasMany(HormonesApplication::class);
    }
    public function birthcontrol()
    {
        return $this->hasMany(BirthControlApplication::class);
    }
    public function exercices()
    {
        return $this->hasMany(ExerciseApplication::class);
    }
    public function assignments()
    {
        return $this->belongsToMany(Staff::class)->withPivot('ass_as');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function debates()
    {
        return $this->hasMany(Debate::class);
    }
    public function statusOne()
    {
        return $this->morphOne(StatusOne::class, 'statusOneable');
    }
    public function notification()
    {
        return $this->morphMany(Notification::class, 'notificationable');
    }
    public function recommended()
    {
        return $this->hasOne(Procedure::class, 'id', 'recommended_id');
    }
    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }
}
