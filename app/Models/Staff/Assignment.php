<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'staff_id', 'service_id', 'email', 'selected', 'additional_emailable_id', 'additional_emailable_type',  'created_at ', 'updated_at'];

    /**
     * Assignment belongs to Staff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        // belongsTo(RelatedModel, foreignKey = staff_id, keyOnRelatedModel = id)
        return $this->belongsTo(Staff::class);
    }

    /**
     * Assignment belongs to Service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        // belongsTo(RelatedModel, foreignKey = service_id, keyOnRelatedModel = id)
        return $this->belongsTo(Service::class);
    }

    public function additionalEmails()
    {
        return $this->morphMany(AdditionalEmail::class, 'additional_emailable');
    }
}
