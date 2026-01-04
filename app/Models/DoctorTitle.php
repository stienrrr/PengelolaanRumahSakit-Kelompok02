<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'front_title',
        'back_title',
        'specialist',
        'user_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
