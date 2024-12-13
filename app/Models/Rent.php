<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'route',
        'scheduled_at',
        'completed_at',
        'status',
        'distance_traveled',
        'coordinates',
        'emergency'
    ];
    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Rent belongs to a Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Rent belongs to a Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}