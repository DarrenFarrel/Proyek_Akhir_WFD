@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="bg-[#EBE3DB] p-8 md:p-12 rounded-2xl shadow-xl max-w-4xl mx-auto text-center transition-all duration-300 hover:shadow-2xl">
        <div class="mb-8">
            <div class="w-20 h-20 bg-[#CBAD8D]/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#CBAD8D]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            
            <h1 class="text-3xl font-serif font-bold text-[#3A2D28] mb-4">Booking Confirmed!</h1>
            <p class="text-[#A48374] mb-8">Thank you for choosing The Westin Jakarta. Your booking details are below.</p>
        </div>
        
        <div class="bg-[#D1C7BD] p-6 rounded-xl mb-8 text-left border-l-4 border-[#A48374]">
            <h2 class="text-xl font-semibold text-[#3A2D28] mb-4">Booking #{{ $booking->booking_number }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm font-medium text-[#A48374] uppercase tracking-wider mb-2">Guest Information</h3>
                    <p class="font-medium text-[#3A2D28]">{{ $booking->user->name }}</p>
                    <p class="text-[#A48374]">{{ $booking->user->email }}</p>
                    @if($booking->user->phone)
                        <p class="text-[#A48374]">{{ $booking->user->phone }}</p>
                    @endif
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-[#A48374] uppercase tracking-wider mb-2">Stay Information</h3>
                    <p class="font-medium text-[#3A2D28]">{{ $booking->room->roomType->name }} (Room {{ $booking->room->room_number }})</p>
                    <p class="text-[#A48374]">
                        {{ $booking->check_in->format('l, F j, Y') }} to {{ $booking->check_out->format('l, F j, Y') }}
                    </p>
                    <p class="text-[#A48374]">{{ $booking->nights }} nights, {{ $booking->guests }} {{ $booking->guests == 1 ? 'Guest' : 'Guests' }}</p>
                </div>
            </div>
            
            <div class="border-t border-[#A48374] pt-6">
                <h3 class="text-sm font-medium text-[#A48374] uppercase tracking-wider mb-2">Payment Summary</h3>
                <div class="flex justify-between items-center font-semibold text-lg text-[#3A2D28]">
                    <span>Total Amount</span>
                    <span>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <div class="mb-8">
            <h3 class="font-semibold text-[#3A2D28] mb-2">Check-in Information</h3>
            <p class="text-[#A48374] mb-2">Check-in time: 2:00 PM</p>
            <p class="text-[#A48374]">Please bring a valid ID for check-in</p>
        </div>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('booking.my-bookings') }}" class="px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                View My Bookings
            </a>
            <button onclick="window.print()" class="px-6 py-3 bg-[#EBE3DB] hover:bg-[#D1C7BD] text-[#A48374] border border-[#A48374] rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                Print Confirmation
            </button>
        </div>
    </div>
</section>
@endsection