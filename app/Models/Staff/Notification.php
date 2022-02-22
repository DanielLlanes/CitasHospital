<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;


    protected $dates = ['deleted_at'];
    protected $fillable = ['staff_id', 'type', 'message', 'code', 'read'];

    public function notificationable()
    {
        return $this->morphTo();
    }
    public function notificationStaff()
    {
        // belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
        return $this->belongsTo(Staff::class);
    }
}
