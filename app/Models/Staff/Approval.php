<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

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
}
