<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;


    protected $dates = ['deleted_at'];
    protected $fillable = ['code', 'type', 'staff_id'];

    public function messageable()
    {
        return $this->morphTo();
    }
    public function debateInverseMessages()
    {
        // belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
        return $this->belongsTo(Debate::class, 'messageable_id');
    }
    /**
     * Message belongs to .
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
}
