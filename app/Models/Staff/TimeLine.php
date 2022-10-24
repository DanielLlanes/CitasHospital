<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLine extends Model
{
    use HasFactory;

    public $timestamps = true;

    public function imageMany()
    {
        return $this->morphMany(ImageMany::class, 'imageManyable');
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
