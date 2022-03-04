<?php

namespace App\Models\Staff;

use App\Models\Staff\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusOne extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    //protected $dates = ['deleted_at'];
    protected $fillable = ['status_id','indications','recomendations','reason','code'];

    public function StatusOneable()
    {
        return $this->morphTo();
    }
    /**
     * StatusOne has one Status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = statusOne_id, localKey = id)
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
