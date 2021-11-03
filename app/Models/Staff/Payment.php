<?php

namespace App\Models\Staff;

use App\Models\Site\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes; //Implementamos

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function paymentMethods()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
