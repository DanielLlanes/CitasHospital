<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;


    protected $fillable = ['application_id', 'staff_id', 'procedure_id', 'code', 'sugerencia', 'unitario', 'dr_fee', 'si_free', 'quote_id'];
    protected $dates = ['deleted_at'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function statusOne()
    {
        return $this->morphOne(StatusOne::class, 'statusOneable');
    }

    /**
     * Suggestion belongs to Quote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
