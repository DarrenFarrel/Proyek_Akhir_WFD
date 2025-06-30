@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-[#3A2D28] mb-2">My Bookings</h1>
        <p class="text-[#A48374]">View and manage your upcoming and past bookings</p>
    </div>

    @if($bookings->isEmpty())
        <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl">
            <div class="w-16 h-16 bg-[#D1C7BD] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#A48374]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-[#3A2D28] mb-4">You don't have any bookings yet</h3>
            <p class="text-[#A48374] mb-6">Start by searching for available rooms for your next stay.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                Book a Room
            </a>
        </div>
    @else
        <div class="bg-[#EBE3DB] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="divide-y divide-[#D1C7BD]">
                @foreach($bookings as $booking)
                    <div class="p-6 hover:bg-[#D1C7BD] transition-colors duration-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <div class="flex items-center">
                                    <h2 class="text-lg font-semibold text-[#3A2D28]">{{ $booking->room->roomType->name }}</h2>
                                    <span class="ml-2 px-3 py-1 text-xs rounded-full 
                                        {{ $booking->status === 'confirmed' ? 'bg-[#CBAD8D] text-[#3A2D28] animate-pulse' : '' }}
                                        {{ $booking->status === 'completed' ? 'bg-[#D1C7BD] text-[#3A2D28]' : '' }}
                                        {{ $booking->status === 'cancelled' ? 'bg-[#A48374] text-[#F1EDE6]' : '' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                <p class="text-[#A48374] text-sm mt-1">
                                    {{ $booking->check_in->format('M d, Y') }} - {{ $booking->check_out->format('M d, Y') }} ({{ $booking->nights }} nights)
                                </p>
                                <p class="text-[#A48374] text-sm">Booking #{{ $booking->booking_number }}</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('booking.confirmation', $booking) }}" class="px-4 py-2 bg-[#EBE3DB] hover:bg-[#D1C7BD] text-[#A48374] border border-[#A48374] rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105">
                                    View Details
                                </a>
                                
                                @if($booking->status === 'completed' && !$booking->review)
                                    <a href="{{ route('review.create', $booking) }}" class="px-4 py-2 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                                        Write Review
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection