@extends('layouts.app')

@section('title', 'Book Your Stay')

@section('content')
<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-[#3A2D28] mb-2">Book Your Stay</h1>
        <p class="text-[#A48374]">{{ $roomType->name }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                <h2 class="text-xl font-semibold text-[#3A2D28] mb-4">Booking Details</h2>
                
                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $availableRooms->first()->id }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Check-in Date</label>
                            <input type="date" name="check_in" id="check_in" 
                                   value="{{ $check_in ?? now()->format('Y-m-d') }}"
                                   min="{{ now()->format('Y-m-d') }}"
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Check-out Date</label>
                            <input type="date" name="check_out" id="check_out"
                                   value="{{ $check_out ?? now()->addDay()->format('Y-m-d') }}"
                                   min="{{ now()->addDay()->format('Y-m-d') }}"
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Duration</label>
                            <div class="p-3 border border-[#A48374] rounded-lg bg-[#D1C7BD] text-center" id="durationDisplay">
                                @isset($nights)
                                {{ $nights }} nights
                                @else
                                1 night
                                @endisset
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[#3A2D28] mb-2">Select Room</label>
                        <div class="space-y-2">
                            @foreach($availableRooms as $room)
                                <div class="flex items-center p-3 border border-[#A48374] rounded-lg hover:bg-[#D1C7BD] transition-colors duration-200">
                                    <input type="radio" name="room_id" id="room_{{ $room->id }}" value="{{ $room->id }}" class="h-4 w-4 text-[#A48374] focus:ring-[#CBAD8D]" {{ $loop->first ? 'checked' : '' }}>
                                    <label for="room_{{ $room->id }}" class="ml-3 block">
                                        <span class="font-medium text-[#3A2D28]">Room {{ $room->room_number }}</span>
                                        <span class="text-sm text-[#A48374] ml-2">Floor {{ $room->floor }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="special_requests" class="block text-sm font-medium text-[#3A2D28] mb-2">Special Requests (Optional)</label>
                        <textarea name="special_requests" id="special_requests" rows="3" class="w-full border border-[#A48374] rounded-lg p-3 focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" placeholder="Any special requests or notes..."></textarea>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center border-t border-[#A48374] pt-6 gap-4">
                        @isset($check_in, $check_out)
                        <a href="{{ route('booking.check') }}?check_in={{ $check_in }}&check_out={{ $check_out }}" class="text-[#A48374] hover:text-[#3A2D28] font-medium transition-colors duration-200">
                            Back to Available Rooms
                        </a>
                        @else
                        <a href="{{ route('home') }}" class="text-[#A48374] hover:text-[#3A2D28] font-medium transition-colors duration-200">
                            Back to Home
                        </a>
                        @endisset
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div>
            <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg sticky top-4 transition-all duration-300 hover:shadow-xl">
                <h2 class="text-xl font-semibold text-[#3A2D28] mb-4">Booking Summary</h2>
                
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[#A48374]">Room Type</span>
                        <span class="font-medium text-[#3A2D28]">{{ $roomType->name }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[#A48374]">Price per night</span>
                        <span class="text-[#3A2D28]">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[#A48374]">Nights</span>
                        <span id="summaryNights" class="text-[#3A2D28]">
                            @isset($nights)
                            {{ $nights }}
                            @else
                            1
                            @endisset
                        </span>
                    </div>
                    <div class="border-t border-[#A48374] my-3"></div>
                    <div class="flex justify-between items-center font-semibold text-lg text-[#3A2D28]">
                        <span>Total</span>
                        <span id="summaryTotal">
                            Rp @isset($total)
                            {{ number_format($total, 0, ',', '.') }}
                            @else
                            {{ number_format($roomType->price_per_night, 0, ',', '.') }}
                            @endisset
                        </span>
                    </div>
                </div>
                
                <div class="border-t border-[#A48374] pt-6">
                    <h3 class="font-semibold text-[#3A2D28] mb-2">Cancellation Policy</h3>
                    <p class="text-sm text-[#A48374]">
                        Free cancellation up to 24 hours before check-in. No refund for late cancellations or no-shows.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const durationDisplay = document.getElementById('durationDisplay');
    const summaryNights = document.getElementById('summaryNights');
    const summaryTotal = document.getElementById('summaryTotal');
    const pricePerNight = {{ $roomType->price_per_night }};

    function calculateDuration() {
        const checkInDate = new Date(checkInInput.value);
        const checkOutDate = new Date(checkOutInput.value);
        
        if (checkOutDate <= checkInDate) {
            const nextDay = new Date(checkInDate);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOutInput.valueAsDate = nextDay;
            checkOutDate = nextDay;
        }

        const timeDiff = checkOutDate - checkInDate;
        const nights = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        
        durationDisplay.textContent = nights + (nights === 1 ? ' night' : ' nights');
        summaryNights.textContent = nights;
        summaryTotal.textContent = 'Rp ' + (pricePerNight * nights).toLocaleString('id-ID');
    }

    checkInInput.addEventListener('change', function() {
        const checkInDate = new Date(this.value);
        const minCheckOutDate = new Date(checkInDate);
        minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
        
        checkOutInput.min = minCheckOutDate.toISOString().split('T')[0];
        
        if (new Date(checkOutInput.value) <= checkInDate) {
            checkOutInput.valueAsDate = minCheckOutDate;
        }
        
        calculateDuration();
    });

    checkOutInput.addEventListener('change', calculateDuration);

    // Initial calculation
    calculateDuration();
});
</script>
@endsection