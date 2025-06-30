<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        if ($booking->user_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403);
        }

        if ($booking->review) {
            return redirect()->route('booking.my-bookings')->with('error', 'You have already reviewed this booking.');
        }

        return view('reviews.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id() || $booking->status !== 'completed') {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'title' => 'required|string|max:100',
            'comment' => 'required|string|max:500'
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'booking_id' => $booking->id,
            'room_type_id' => $booking->room->room_type_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment
        ]);

        return redirect()->route('booking.my-bookings')->with('success', 'Thank you for your review!');
    }
}