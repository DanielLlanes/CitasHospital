<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationApplication extends Model
{
    use HasFactory;
    protected $fillable = ['application_id',' name', 'reason', 'dosage', 'frecuency'];
}