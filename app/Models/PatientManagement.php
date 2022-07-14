<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_code','case_status','age','province','pat_location_name','inputted_by','updated_by','updated_at',
    ];

    protected $table = 'patients';
}
