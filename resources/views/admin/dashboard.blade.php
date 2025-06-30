@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">Admin Dashboard</h1>
                <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                    <h3 class="text-lg font-medium text-[#3A2D28] mb-2">New Bookings</h3>
                    <p class="text-4xl font-bold text-[#A48374]">{{ $newBookings }}</p>
                    <div class="mt-4 h-1 bg-gradient-to-r from-[#A48374]/20 to-[#CBAD8D]/20 rounded-full"></div>
                </div>
                <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                    <h3 class="text-lg font-medium text-[#3A2D28] mb-2">Today's Check-ins</h3>
                    <p class="text-4xl font-bold text-[#CBAD8D]">{{ $checkIns }}</p>
                    <div class="mt-4 h-1 bg-gradient-to-r from-[#CBAD8D]/20 to-[#A48374]/20 rounded-full"></div>
                </div>
                <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                    <h3 class="text-lg font-medium text-[#3A2D28] mb-2">Today's Check-outs</h3>
                    <p class="text-4xl font-bold text-[#3A2D28]">{{ $checkOuts }}</p>
                    <div class="mt-4 h-1 bg-gradient-to-r from-[#3A2D28]/20 to-[#CBAD8D]/20 rounded-full"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                    <h3 class="text-lg font-medium mb-4 text-[#3A2D28]">Upcoming Arrivals</h3>
                    <div class="space-y-4">
                        @foreach($upcomingArrivals as $booking)
                        <div class="border-b border-[#D1C7BD] pb-4 last:border-b-0 last:pb-0">
                            <p class="font-medium text-[#3A2D28]">{{ $booking->booking_number }} - {{ $booking->user->name }}</p>
                            <p class="text-sm text-[#A48374]">
                                {{ $booking->room->roomType->name }} - 
                                Arrival: {{ $booking->check_in->format('M d, Y H:i') }}
                            </p>
                            <div class="mt-2 flex gap-2">
                                <a href="{{ route('admin.bookings.index') }}?status=confirmed" class="text-xs px-3 py-1 bg-[#CBAD8D] hover:bg-[#CBAD8D]/80 text-[#3A2D28] rounded-full transition-colors duration-200">
                                    View All
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                    <h3 class="text-lg font-medium mb-4 text-[#3A2D28]">Recent Reviews</h3>
                    <div class="space-y-4">
                        @foreach($recentReviews as $review)
                        <div class="border-b border-[#D1C7BD] pb-4 last:border-b-0 last:pb-0">
                            <div class="flex items-center mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <svg class="w-5 h-5 text-[#CBAD8D]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-[#A48374]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="font-medium text-[#3A2D28]">{{ $review->title }}</p>
                            <p class="text-sm text-[#A48374]">{{ Str::limit($review->comment, 100) }}</p>
                            @if(!$review->admin_reply)
                                <a href="{{ route('admin.reviews.index') }}#review-{{ $review->id }}" class="text-sm text-[#A48374] hover:text-[#3A2D28] transition-colors duration-200">Reply</a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection