<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'guests',
        'total_amount',
        'status',
        'special_requests'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function getNightsAttribute()
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }
}