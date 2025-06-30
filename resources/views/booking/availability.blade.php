@extends('layouts.app')

@section('title', 'Room Availability')

@section('content')
<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-[#3A2D28] mb-2">Available Rooms</h1>
        @isset($search)
        <p class="text-[#A48374]">
            {{ \Carbon\Carbon::parse($search['check_in'])->format('M d, Y') }} to 
            {{ \Carbon\Carbon::parse($search['check_out'])->format('M d, Y') }}
        </p>
        @endisset
    </div>

    @if($availableRoomTypes->isEmpty())
        <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg text-center transition-all duration-300 hover:shadow-xl">
            <div class="w-16 h-16 bg-[#D1C7BD] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#A48374]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-[#3A2D28] mb-4">No rooms available for your selected dates</h3>
            <p class="text-[#A48374] mb-6">Please try adjusting your dates.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                Search Again
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-8">
            @foreach($availableRoomTypes as $roomType)
                <div class="bg-[#EBE3DB] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            @if($roomType->name === 'Deluxe Room')
                                <img src="{{ asset('storage/images/deluxe.jpg') }}" alt="Deluxe Room" class="w-full h-64 md:h-full object-cover transition-transform duration-500 hover:scale-105">
                            @elseif($roomType->name === 'Premier Suite')
                                <img src="{{ asset('storage/images/premiere.jpg') }}" alt="Premier Suite" class="w-full h-64 md:h-full object-cover transition-transform duration-500 hover:scale-105">
                            @elseif($roomType->name === 'Executive Lounge')
                                <img src="{{ asset('storage/images/executive.jpg') }}" alt="Executive Lounge" class="w-full h-64 md:h-full object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <img src="{{ $roomType->image_url }}" alt="{{ $roomType->name }}" class="w-full h-64 md:h-full object-cover transition-transform duration-500 hover:scale-105">
                            @endif
                        </div>
                        <div class="p-6 md:w-2/3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-serif font-bold text-[#3A2D28] mb-2">{{ $roomType->name }}</h2>
                                    <div class="flex items-center mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 text-[#CBAD8D]" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span class="text-xs text-[#A48374] ml-1">(24 reviews)</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-[#3A2D28]">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</p>
                                    <p class="text-sm text-[#A48374]">per night</p>
                                </div>
                            </div>
                            
                            <p class="text-[#3A2D28] mb-4">{{ $roomType->description }}</p>
                            
                            <div class="flex justify-end">
                                @isset($search)
                                <a href="{{ route('booking.create', $roomType) }}?check_in={{ $search['check_in'] }}&check_out={{ $search['check_out'] }}" class="px-6 py-2 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                                    Book Now
                                </a>
                                @else
                                <a href="{{ route('booking.create', $roomType) }}" class="px-6 py-2 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                                    Book Now
                                </a>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection