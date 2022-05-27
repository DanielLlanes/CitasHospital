<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at']; //Registramos la nueva columna


    public function service()
    {
        return $this->hasOne(Service::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function imageOne()
    {
        return $this->morphOne(ImageOne::class, 'imageOneable');
    }
    public function descriptionOne()
    {
        return $this->morphOne(DescriptionOne::class, 'descriptionOneable');
    }
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    /**
     * Brand has many Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureBrand()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = brand_id, localKey = id)
        return $this->hasManyThrough(Procedure::class, Service::class);
    }
}
