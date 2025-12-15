<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'contact',
        'location',
        'latitude',
        'longitude',
        'capacity',
        'current_occupancy',
        'is_verified',
        'description',
        'website',
        'email',
        'image',
        'user_id'
    ];

    public function dogs()
    {
        return $this->hasMany(Doge::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
