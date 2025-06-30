<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'description',
        'main_image'
    ];

    protected static function booted()
    {
        static::created(function ($hotel) {
            if (self::count() > 1) {
                abort(400, 'Only one hotel information record can exist.');
            }
        });
    }

    public function getMainImageUrlAttribute()
    {
        return asset('storage/' . $this->main_image);
    }
}