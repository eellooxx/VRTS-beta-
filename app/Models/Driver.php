<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    
    use HasFactory, HasApiTokens;

    protected $table = 'drivers'; // Ensure this matches your database table name

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'contact',
        'address',
        'age',
        'birthday',
        'password',
        'is_active',
        'user_id'
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function setPasswordAttribute($value)
    {
        // $this->attributes['password'] = bcrypt($value);
        $this->attributes['password'] = Hash::make($value);
    }
    // Modified for Challenges
    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}