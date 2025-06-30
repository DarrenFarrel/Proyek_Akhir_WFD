@extends('layouts.app')

@section('title', 'Manage Bookings')

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">Bookings Management</h1>
                <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
            </div>
            
            <div class="bg-[#EBE3DB] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#D1C7BD]">
                        <thead class="bg-gradient-to-r from-[#A48374] to-[#CBAD8D]">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Booking #</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Guest</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Room</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Dates</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#EBE3DB] divide-y divide-[#D1C7BD]">
                            @foreach($bookings as $booking)
                            <tr class="hover:bg-[#D1C7BD] transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-[#3A2D28] font-medium">{{ $booking->booking_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#3A2D28]">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#3A2D28]">
                                    {{ $booking->room->roomType->name }} ({{ $booking->room->room_number }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#3A2D28]">
                                    {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $booking->status === 'confirmed' ? 'bg-[#CBAD8D] text-[#3A2D28] animate-pulse' : 
                                           ($booking->status === 'completed' ? 'bg-[#D1C7BD] text-[#3A2D28]' : 'bg-[#A48374] text-[#F1EDE6]') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.bookings.status', ['booking' => $booking, 'status' => 'confirmed']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs px-3 py-1 bg-[#CBAD8D] hover:bg-[#CBAD8D]/80 text-[#3A2D28] rounded-full transition-colors duration-200" 
                                                    {{ $booking->status === 'confirmed' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>
                                                Confirm
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.status', ['booking' => $booking, 'status' => 'completed']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs px-3 py-1 bg-[#D1C7BD] hover:bg-[#D1C7BD]/80 text-[#3A2D28] rounded-full transition-colors duration-200" 
                                                    {{ $booking->status === 'completed' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>
                                                Complete
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.status', ['booking' => $booking, 'status' => 'cancelled']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs px-3 py-1 bg-[#A48374] hover:bg-[#A48374]/80 text-[#F1EDE6] rounded-full transition-colors duration-200" 
                                                    {{ $booking->status === 'cancelled' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 bg-[#D1C7BD] border-t border-[#A48374]">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
