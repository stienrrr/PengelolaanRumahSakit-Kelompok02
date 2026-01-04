<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionsItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'quantity',
        'dosage',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescriptions::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
