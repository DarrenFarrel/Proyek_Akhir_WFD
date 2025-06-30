<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
        'facilities',
        'image'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}