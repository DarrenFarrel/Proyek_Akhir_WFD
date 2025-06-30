@extends('layouts.app')

@section('title', 'About The Westin Jakarta')

@section('content')
<div class="relative h-96 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-t from-[#3A2D28] to-transparent opacity-80"></div>
    <img src="{{ asset('storage/images/lobby.jpg') }}" alt="Westin Hotel Jakarta Lobby" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-1000">
    <div class="absolute inset-0 flex items-center justify-center text-center px-4">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#F1EDE6]">ABOUT THE WESTIN JAKARTA</h1>
    </div>
</div>

<section class="py-16 px-4 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <h2 class="text-3xl font-serif font-bold text-[#3A2D28]">Luxury in the Heart of Jakarta</h2>
            <div class="prose max-w-none">
                <p class="text-[#3A2D28]">
                    Located in Jakarta's golden triangle, The Westin Jakarta offers 300 luxurious rooms and suites with breathtaking views of the city skyline.
                </p>
                <p class="text-[#3A2D28]">
                    Our hotel features world-class amenities including an infinity pool, spa, fitness center, and multiple dining options to satisfy every palate.
                </p>
                <p class="text-[#3A2D28]">
                    The Westin Jakarta is the perfect choice for both business and leisure travelers, offering state-of-the-art meeting facilities alongside relaxing retreats.
                </p>
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Hotel Information</h3>
                    <address class="not-italic text-[#3A2D28] space-y-1">
                        <p class="mb-1"><strong>Address:</strong> {{ $hotelInfo->address ?? 'Jalan HR Rasuna Said Kav C-22, Jakarta 12940, Indonesia' }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $hotelInfo->phone ?? '+62 21 2788 7788' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $hotelInfo->email ?? 'reservation@westinjakarta.com' }}</p>
                    </address>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <img src="{{ asset('storage/images/infinitypool.jpg') }}" alt="Infinity Pool" class="rounded-xl shadow-md h-64 w-full object-cover transform hover:scale-105 transition-transform duration-500">
            <img src="{{ asset('storage/images/spa.jpg') }}" alt="Spa" class="rounded-xl shadow-md h-64 w-full object-cover transform hover:scale-105 transition-transform duration-500">
            <img src="{{ asset('storage/images/restaurant.jpg') }}" alt="Restaurant" class="rounded-xl shadow-md h-64 w-full object-cover transform hover:scale-105 transition-transform duration-500">
            <img src="{{ asset('storage/images/ballroom.jpg') }}" alt="Ballroom" class="rounded-xl shadow-md h-64 w-full object-cover transform hover:scale-105 transition-transform duration-500">
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-br from-[#F1EDE6] to-[#D1C7BD] px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-serif font-bold text-center text-[#3A2D28] mb-12">AWARDS & RECOGNITIONS</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="text-[#CBAD8D] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Best Luxury Hotel 2023</h3>
                <p class="text-[#A48374]">World Luxury Hotel Awards</p>
            </div>
            
            <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="text-[#CBAD8D] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Travelers' Choice 2023</h3>
                <p class="text-[#A48374]">TripAdvisor</p>
            </div>
            
            <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                <div class="text-[#CBAD8D] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#3A2D28] mb-2">Green Hotel Certification</h3>
                <p class="text-[#A48374]">Ministry of Tourism</p>
            </div>
        </div>
    </div>
</section>
@endsection