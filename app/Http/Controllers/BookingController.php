<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class BookingController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $availableRoomTypes = RoomType::whereHas('rooms', function($query) use ($request) {
                $query->whereDoesntHave('bookings', function($q) use ($request) {
                    $q->where(function($query) use ($request) {
                        $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                            ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                            ->orWhere(function($q) use ($request) {
                                $q->where('check_in', '<', $request->check_in)
                                    ->where('check_out', '>', $request->check_out);
                            });
                    })
                    ->whereIn('status', ['pending', 'confirmed']);
                })
                ->where('status', 'available');
            })
            ->get();

        return view('booking.availability', [
            'availableRoomTypes' => $availableRoomTypes,
            'search' => [
                'check_in' => $request->check_in,
                'check_out' => $request->check_out
            ]
        ]);
    }

    public function create(Request $request, RoomType $roomType)
    {
        $check_in = $request->check_in ?? now()->format('Y-m-d');
        $check_out = $request->check_out ?? now()->addDay()->format('Y-m-d');

        $availableRooms = $roomType->rooms()
            ->whereDoesntHave('bookings', function($query) use ($check_in, $check_out) {
                $query->where(function($q) use ($check_in, $check_out) {
                    $q->whereBetween('check_in', [$check_in, $check_out])
                      ->orWhereBetween('check_out', [$check_in, $check_out])
                      ->orWhere(function($q) use ($check_in, $check_out) {
                          $q->where('check_in', '<', $check_in)
                            ->where('check_out', '>', $check_out);
                      });
                })
                ->whereIn('status', ['pending', 'confirmed']);
            })
            ->where('status', 'available')
            ->get();

        if ($availableRooms->isEmpty()) {
            return back()->with('error', 'No rooms available for the selected dates.');
        }

        $nights = (new \DateTime($check_in))->diff(new \DateTime($check_out))->days;
        $total = $nights * $roomType->price_per_night;

        return view('booking.create', [
            'roomType' => $roomType,
            'availableRooms' => $availableRooms,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'nights' => $nights,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'special_requests' => 'nullable|string|max:500'
        ]);

        $room = Room::findOrFail($request->room_id);
        $roomType = $room->roomType;

        $nights = (new \DateTime($request->check_in))->diff(new \DateTime($request->check_out))->days;
        $total = $nights * $roomType->price_per_night;

        $bookingNumber = 'WSTN-' . date('Y') . '-' . str_pad(Booking::count() + 1, 3, '0', STR_PAD_LEFT);

        $booking = Booking::create([
            'booking_number' => $bookingNumber,
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => 1,
            'total_amount' => $total,
            'status' => 'confirmed',
            'special_requests' => $request->special_requests
        ]);

        try {
            Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));
        } catch (\Exception $e) {
            \Log::error('Failed to send booking confirmation email: ' . $e->getMessage());
        }

        return redirect()->route('booking.confirmation', $booking)->with('success', 'Booking confirmed!');
    }

    public function confirmation(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('booking.confirmation', compact('booking'));
    }

    public function myBookings()
    {
        $bookings = auth()->user()->bookings()->latest()->get();
        return view('booking.my-bookings', compact('bookings'));
    }
}