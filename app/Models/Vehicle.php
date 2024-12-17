<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'color',
        'odometer',
        'description',
        'status',
        'image',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}