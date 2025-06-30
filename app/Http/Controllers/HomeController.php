<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\HotelInformation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::with('rooms')->get();
        $hotelInfo = HotelInformation::first();
        
        return view('home', compact('roomTypes', 'hotelInfo'));
    }

    public function about()
    {
        $hotelInfo = HotelInformation::first();
        return view('about', compact('hotelInfo'));
    }
}