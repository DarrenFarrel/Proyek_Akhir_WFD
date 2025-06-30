@extends('layouts.app')

@section('title', 'Manage Reviews')

@section('content')
<div class="flex min-h-screen bg-[#F1EDE6]">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#3A2D28] mb-2 font-serif">Guest Reviews</h1>
                <div class="w-20 h-1 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] rounded-full"></div>
            </div>
            
            <div class="bg-[#EBE3DB] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="divide-y divide-[#D1C7BD]">
                    @foreach($reviews as $review)
                    <div class="p-6 hover:bg-[#D1C7BD] transition-colors duration-200" id="review-{{ $review->id }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <svg class="w-5 h-5 text-[#CBAD8D] transform hover:scale-125 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-[#A48374]" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <h3 class="text-lg font-semibold text-[#3A2D28]">{{ $review->title }}</h3>
                                <p class="text-[#3A2D28] mb-2">{{ $review->comment }}</p>
                                <p class="text-sm text-[#A48374]">By {{ $review->user->name }} on {{ $review->created_at->format('M d, Y') }}</p>
                                
                                @if($review->admin_reply)
                                    <div class="mt-4 p-4 bg-[#D1C7BD] rounded-lg border-l-4 border-[#CBAD8D]">
                                        <h4 class="font-medium text-[#3A2D28]">Admin Reply:</h4>
                                        <p class="text-[#3A2D28]">{{ $review->admin_reply }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 gap-4">
                            @if(!$review->admin_reply)
                            <form action="{{ route('admin.reviews.reply', $review) }}" method="POST" class="flex-1 w-full">
                                @csrf
                                <div class="flex flex-col sm:flex-row items-center gap-2">
                                    <textarea name="admin_reply" rows="2" class="w-full border border-[#A48374] rounded-lg p-3 focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" required placeholder="Type your reply here..."></textarea>
                                    <button type="submit" class="px-4 py-2 bg-[#CBAD8D] hover:bg-[#CBAD8D]/80 text-[#3A2D28] rounded-lg text-sm whitespace-nowrap transition-all duration-200 transform hover:scale-105">
                                        Submit Reply
                                    </button>
                                </div>
                            </form>
                            @endif
                            
                            <form action="{{ route('admin.reviews.delete', $review) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-[#A48374] hover:bg-[#A48374]/80 text-[#F1EDE6] rounded-lg text-sm whitespace-nowrap transition-all duration-200 transform hover:scale-105" onclick="return confirm('Are you sure you want to delete this review?')">
                                    Delete Review
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="px-6 py-4 bg-[#D1C7BD] border-t border-[#A48374]">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection