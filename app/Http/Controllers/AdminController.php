<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\HotelInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function dashboard()
    {
        $today = now()->format('Y-m-d');
        
        $data = [
            'newBookings' => Booking::whereDate('created_at', $today)->count(),
            'checkIns' => Booking::whereDate('check_in', $today)->where('status', 'confirmed')->count(),
            'checkOuts' => Booking::whereDate('check_out', $today)->where('status', 'confirmed')->count(),
            'upcomingArrivals' => Booking::with('user', 'room.roomType')
                ->whereDate('check_in', '>=', $today)
                ->where('status', 'confirmed')
                ->orderBy('check_in')
                ->take(5)
                ->get(),
            'recentReviews' => Review::with('user', 'roomType')
                ->latest()
                ->take(5)
                ->get()
        ];

        return view('admin.dashboard', $data);
    }

    public function manageRooms()
    {
        $roomTypes = RoomType::withCount('rooms')->get();
        return view('admin.rooms.index', compact('roomTypes'));
    }

    public function createRoomType()
    {
        return view('admin.rooms.create');
    }

    public function storeRoomType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'required|string',
            'image' => 'required|image|max:2048'
        ]);

        $imagePath = $request->file('image')->store('room-types', 'public');
        
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(800, 600);
        $image->save();

        RoomType::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_night' => $request->price_per_night,
            'capacity' => $request->capacity,
            'facilities' => $request->facilities,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room type created successfully.');
    }

    public function editRoomType(RoomType $roomType)
    {
        return view('admin.rooms.edit', compact('roomType'));
    }

    public function updateRoomType(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name', 'description', 'price_per_night', 'capacity', 'facilities']);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $roomType->image);
            
            $imagePath = $request->file('image')->store('room-types', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(800, 600);
            $image->save();
            
            $data['image'] = $imagePath;
        }

        $roomType->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Room type updated successfully.');
    }

    public function manageRoomList(RoomType $roomType)
    {
        $rooms = $roomType->rooms()->orderBy('room_number')->get();
        return view('admin.rooms.room-list', compact('roomType', 'rooms'));
    }

    public function addRoom(Request $request, RoomType $roomType)
    {
        $request->validate([
            'room_number' => 'required|string|max:10|unique:rooms,room_number',
            'floor' => 'required|integer|min:1'
        ]);

        $roomType->rooms()->create([
            'room_number' => $request->room_number,
            'floor' => $request->floor
        ]);

        return back()->with('success', 'Room added successfully.');
    }

    public function updateRoomStatus(Room $room)
    {
        $room->update([
            'status' => $room->status === 'available' ? 'unavailable' : 'available'
        ]);

        return back()->with('success', 'Room status updated.');
    }

    public function hotelInfo()
    {
        $hotelInfo = HotelInformation::firstOrNew();
        return view('admin.hotel-info', compact('hotelInfo'));
    }

    public function updateHotelInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'description' => 'required|string',
            'main_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name', 'address', 'phone', 'email', 'description']);
        $hotelInfo = HotelInformation::firstOrNew();

        if ($request->hasFile('main_image')) {
            if ($hotelInfo->main_image) {
                Storage::delete('public/' . $hotelInfo->main_image);
            }
            
            $imagePath = $request->file('main_image')->store('hotel', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 800);
            $image->save();
            
            $data['main_image'] = $imagePath;
        }

        $hotelInfo->fill($data)->save();

        return back()->with('success', 'Hotel information updated successfully.');
    }

    public function manageBookings()
    {
        $bookings = Booking::with(['user', 'room.roomType'])
            ->latest()
            ->paginate(10);
            
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateBookingStatus(Booking $booking, $status)
    {
        if (!in_array($status, ['confirmed', 'completed', 'cancelled'])) {
            return back()->with('error', 'Invalid status.');
        }

        $booking->update(['status' => $status]);
        return back()->with('success', 'Booking status updated.');
    }

    public function manageReviews()
    {
        $reviews = Review::with(['user', 'roomType'])
            ->latest()
            ->paginate(10);
            
        return view('admin.reviews.index', compact('reviews'));
    }

    public function replyToReview(Request $request, Review $review)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:500'
        ]);

        $review->update(['admin_reply' => $request->admin_reply]);
        return back()->with('success', 'Reply submitted.');
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}