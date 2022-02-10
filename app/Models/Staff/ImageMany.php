<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageMany extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['deleted_at'];
        
    protected $fillable = ['image', 'code', 'title', 'type', 'order', 'code'];

    public function ImageManyable()
    {
        return $this->morphTo();
    }
}
