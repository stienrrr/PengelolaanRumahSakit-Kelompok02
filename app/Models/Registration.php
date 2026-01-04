<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_code',
        'patient_id',
        'doctor_schedule_id',
        'registration_date',
        'queue_number',
        'complaint_initial',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctorSchedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id');
    }
}
