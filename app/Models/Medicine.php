<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'stock',
        'unit',
        'price',
        'description',
        'expiry_date',
    ];

    public function prescriptionsItems()
    {
        return $this->hasMany(PrescriptionsItems::class);
    }
}
