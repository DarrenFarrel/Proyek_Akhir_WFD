@extends('layouts.app')

@section('content')
<div class="relative h-screen overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-t from-[#3A2D28] to-transparent opacity-70"></div>
    <img src="{{ asset('storage/images/westin.jpg') }}" alt="Westin Hotel Jakarta" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-1000">
    <div class="absolute inset-0 flex items-center justify-center text-center px-4">
        <div class="text-[#F1EDE6] max-w-4xl">
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6">WESTIN HOTEL JAKARTA</h1>
            <p class="text-xl md:text-2xl mb-8">Luxury Redefined</p>
            
            <div class="bg-[#EBE3DB] bg-opacity-90 p-4 md:p-6 rounded-xl shadow-lg text-[#3A2D28] transform transition-all duration-500 hover:scale-105">
                <form action="{{ route('booking.check') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4" id="bookingForm">
                    <div>
                        <label class="block text-sm font-medium mb-2">CHECK-IN</label>
                        <input type="date" name="check_in" id="check_in" class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">CHECK-OUT</label>
                        <input type="date" name="check_out" id="check_out" class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md">
                            CHECK AVAILABILITY
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="py-16 px-4 max-w-7xl mx-auto">
    <h2 class="text-3xl font-serif font-bold text-center text-[#3A2D28] mb-12">OUR ROOM TYPES</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($roomTypes as $roomType)
        <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:-translate-y-1">
            @if($roomType->name === 'Deluxe Room')
                <img src="{{ asset('storage/images/deluxe.jpg') }}" alt="Deluxe Room" class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
            @elseif($roomType->name === 'Premier Suite')
                <img src="{{ asset('storage/images/premiere.jpg') }}" alt="Premier Suite" class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
            @elseif($roomType->name === 'Executive Lounge')
                <img src="{{ asset('storage/images/executive.jpg') }}" alt="Executive Lounge" class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
            @else
                <img src="{{ $roomType->image_url }}" alt="{{ $roomType->name }}" class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
            @endif
            <div class="p-6">
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">{{ $roomType->name }}</h3>
                <p class="text-[#A48374] mb-4">{{ Str::limit($roomType->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-[#3A2D28]">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}/night</span>
                    <a href="{{ route('booking.create', $roomType) }}" class="text-[#A48374] hover:text-[#3A2D28] font-medium transition-colors duration-200">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="py-16 bg-gradient-to-br from-[#F1EDE6] to-[#D1C7BD] px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-serif font-bold text-center text-[#3A2D28] mb-12">HOTEL FACILITIES</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="mb-4">
                    <img src="{{ asset('storage/images/lobby.jpg') }}" alt="Luxury Rooms" class="w-full h-32 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Luxury Rooms</h3>
                <p class="text-[#A48374]">Spacious rooms with premium amenities and stunning city views.</p>
            </div>
            
            <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="mb-4">
                    <img src="{{ asset('storage/images/infinitypool.jpg') }}" alt="Infinity Pool" class="w-full h-32 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Infinity Pool</h3>
                <p class="text-[#A48374]">Rooftop infinity pool with panoramic views of Jakarta skyline.</p>
            </div>
            
            <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="mb-4">
                    <img src="{{ asset('storage/images/spa.jpg') }}" alt="World-Class Spa" class="w-full h-32 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">World-Class Spa</h3>
                <p class="text-[#A48374]">Rejuvenate with our signature treatments and therapies.</p>
            </div>
            
            <div class="bg-[#EBE3DB] p-6 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="mb-4">
                    <img src="{{ asset('storage/images/restaurant.jpg') }}" alt="Fine Dining" class="w-full h-32 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Fine Dining</h3>
                <p class="text-[#A48374]">Multiple restaurants offering international and local cuisine.</p>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const bookingForm = document.getElementById('bookingForm');

    checkInInput.addEventListener('change', function() {
        if (this.value) {
            const checkInDate = new Date(this.value);
            const nextDay = new Date(checkInDate);
            nextDay.setDate(checkInDate.getDate() + 1);
            
            const nextDayFormatted = nextDay.toISOString().split('T')[0];
            
            checkOutInput.min = nextDayFormatted;
            
            if (checkOutInput.value && new Date(checkOutInput.value) <= checkInDate) {
                checkOutInput.value = nextDayFormatted;
            }
        }
    });

    bookingForm.addEventListener('submit', function(e) {
        const checkInDate = new Date(checkInInput.value);
        const checkOutDate = new Date(checkOutInput.value);
        
        if (checkOutDate <= checkInDate) {
            e.preventDefault();
            alert('Check-out date must be after check-in date');
        }
    });
});
</script>
@endsection