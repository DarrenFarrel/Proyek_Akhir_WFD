@extends('layouts.app')

@section('title', 'Edit Room Type')

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">Edit Room Type</h1>
                <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
            </div>
            
            <div class="bg-[#EBE3DB] p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                <form action="{{ route('admin.rooms.update', $roomType) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Name</label>
                            <input type="text" name="name" value="{{ old('name', $roomType->name) }}" required
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Price per night</label>
                            <input type="number" name="price_per_night" value="{{ old('price_per_night', $roomType->price_per_night) }}" required min="0"
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Facilities</label>
                            <input type="text" name="facilities" value="{{ old('facilities', $roomType->facilities) }}" required
                                   class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3A2D28] mb-2">Description</label>
                            <textarea name="description" rows="3" required
                                      class="w-full p-3 border border-[#A48374] rounded-lg focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200">{{ old('description', $roomType->description) }}</textarea>
                        </div>
                        
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('admin.rooms.index') }}" class="px-6 py-3 bg-[#A48374] hover:bg-[#A48374]/80 text-[#F1EDE6] rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md">
                            Update Room Type
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection