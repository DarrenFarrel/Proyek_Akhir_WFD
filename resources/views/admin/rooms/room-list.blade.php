@extends('layouts.app')

@section('title', 'Room List - ' . $roomType->name)

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">{{ $roomType->name }} Rooms</h1>
                    <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
                </div>
                <button onclick="document.getElementById('add-room-modal').classList.remove('hidden')" 
                        class="px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md mt-4 sm:mt-0">
                    Add New Room
                </button>
            </div>
            
            <div class="bg-[#EBE3DB] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#D1C7BD]">
                        <thead class="bg-gradient-to-r from-[#A48374] to-[#CBAD8D]">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Room Number</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Floor</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#EBE3DB] divide-y divide-[#D1C7BD]">
                            @foreach($rooms as $room)
                            <tr class="hover:bg-[#D1C7BD] transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-[#3A2D28] font-medium">{{ $room->room_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#3A2D28]">{{ $room->floor }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $room->status === 'available' ? 'bg-[#CBAD8D] text-[#3A2D28]' : 'bg-[#A48374] text-[#F1EDE6]' }}">
                                        {{ ucfirst($room->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.rooms.status', $room) }}" method="POST" class="inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="text-[#A48374] hover:text-[#A48374]/80 mr-3 transition-colors duration-200">
                                            Toggle Status
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Room Modal -->
<div id="add-room-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-[#EBE3DB] rounded-xl p-8 max-w-md w-full mx-4 shadow-2xl transform transition-all duration-300 scale-95 hover:scale-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#3A2D28]">Add New Room</h2>
            <button onclick="document.getElementById('add-room-modal').classList.add('hidden')" 
                    class="text-[#A48374] hover:text-[#3A2D28] transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.rooms.add', $roomType) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-[#3A2D28] text-sm font-bold mb-2" for="room_number">
                    Room Number
                </label>
                <input type="text" name="room_number" id="room_number" required 
                       class="shadow appearance-none border border-[#A48374] rounded-lg w-full py-3 px-4 text-[#3A2D28] leading-tight focus:outline-none focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
            </div>
            <div class="mb-6">
                <label class="block text-[#3A2D28] text-sm font-bold mb-2" for="floor">
                    Floor
                </label>
                <input type="number" name="floor" id="floor" required min="1"
                       class="shadow appearance-none border border-[#A48374] rounded-lg w-full py-3 px-4 text-[#3A2D28] leading-tight focus:outline-none focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="document.getElementById('add-room-modal').classList.add('hidden')" 
                        class="px-6 py-2 bg-[#A48374] hover:bg-[#A48374]/80 text-[#F1EDE6] rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                    Add Room
                </button>
            </div>
        </form>
    </div>
</div>
@endsection