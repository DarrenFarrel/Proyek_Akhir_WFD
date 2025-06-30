@extends('layouts.app')

@section('title', 'Room Management')

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">Room Types</h1>
                    <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
                </div>
            </div>
            
            <div class="bg-[#EBE3DB] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="divide-y divide-[#D1C7BD]">
                    @foreach($roomTypes as $roomType)
                        <div class="p-6 hover:bg-[#D1C7BD] transition-colors duration-200">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <h2 class="text-lg font-semibold text-[#3A2D28]">{{ $roomType->name }}</h2>
                                        <p class="text-[#3A2D28] text-sm">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }} per night</p>
                                        <p class="text-[#3A2D28] text-sm">{{ $roomType->rooms_count }} rooms</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 mt-4 md:mt-0">
                                    <a href="{{ route('admin.rooms.list', $roomType) }}" class="px-4 py-2 bg-[#D1C7BD] hover:bg-[#D1C7BD]/80 text-[#3A2D28] rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105">
                                        Manage Rooms
                                    </a>
                                    <a href="{{ route('admin.rooms.edit', $roomType) }}" class="px-4 py-2 bg-[#CBAD8D] hover:bg-[#CBAD8D]/80 text-[#3A2D28] rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection