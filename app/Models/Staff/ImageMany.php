<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMany extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'code', 'title', 'type', 'order'];

    public function ImageManyable()
    {
        return $this->morphTo();
    }
}
