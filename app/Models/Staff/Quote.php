<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;


    /**
     * Quote has many Suggestions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }

    /**
     * Quote belongs to Application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
        // belongsTo(RelatedModel, foreignKey = application_id, keyOnRelatedModel = id)
        return $this->belongsTo(Application::class, 'applications_id', 'id');
    }

    public function statusOne()
    {
        return $this->morphOne(StatusOne::class, 'statusOneable');
    }
}
