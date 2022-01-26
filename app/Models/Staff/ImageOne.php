<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOne extends Model
{
    use HasFactory;
    protected $fillable = ['image'];

    public function ImageOneable()
    {
        return $this->morphTo();
    }
}