<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOne extends Model
{
    use HasFactory;
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['image'];
    /**
     * ImageOne morphs to models in imageable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function ImageOneable()
    {
        return $this->morphTo();
    }
}
