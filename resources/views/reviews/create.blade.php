@extends('layouts.app')

@section('title', 'Write a Review')

@section('content')
<section class="py-12 px-4 max-w-7xl mx-auto">
    <div class="bg-[#EBE3DB] p-8 md:p-12 rounded-2xl shadow-xl max-w-4xl mx-auto transition-all duration-300 hover:shadow-2xl">
        <h1 class="text-3xl font-serif font-bold text-[#3A2D28] mb-6">Share Your Experience</h1>
        
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-[#3A2D28] mb-2">Your Stay at The Westin Jakarta</h2>
            <p class="text-[#A48374]">
                {{ $booking->room->roomType->name }} | 
                {{ $booking->check_in->format('M d, Y') }} - {{ $booking->check_out->format('M d, Y') }}
            </p>
        </div>
        
        <form action="{{ route('review.store', $booking) }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-[#3A2D28] mb-2">Overall Rating</label>
                <div class="flex items-center" id="rating-container">
                    @for($i = 1; $i <= 5; $i++)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden">
                        <label for="star{{ $i }}" class="text-3xl cursor-pointer text-[#A48374] mr-1 star-label transition-all duration-200 hover:scale-125 hover:text-[#CBAD8D]">
                            ★
                        </label>
                    @endfor
                </div>
            </div>
            
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-[#3A2D28] mb-2">Review Title</label>
                <input type="text" name="title" id="title" class="w-full border border-[#A48374] rounded-lg p-3 focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" required>
            </div>
            
            <div class="mb-6">
                <label for="comment" class="block text-sm font-medium text-[#3A2D28] mb-2">Your Review</label>
                <textarea name="comment" id="comment" rows="5" class="w-full border border-[#A48374] rounded-lg p-3 focus:ring-2 focus:ring-[#CBAD8D] focus:border-transparent transition-all duration-200" required></textarea>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-end gap-4">
                <a href="{{ route('booking.my-bookings') }}" class="px-6 py-2 bg-[#EBE3DB] hover:bg-[#D1C7BD] text-[#3A2D28] border border-[#A48374] rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#A48374] to-[#CBAD8D] hover:from-[#A48374]/90 hover:to-[#CBAD8D]/90 text-[#3A2D28] rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-md" id="submit-btn" disabled>
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-label');
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    const submitBtn = document.getElementById('submit-btn');
    let selectedRating = 0;

    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            selectedRating = index + 1;
            
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.remove('text-[#A48374]');
                    s.classList.add('text-[#CBAD8D]');
                    s.classList.add('scale-125');
                } else {
                    s.classList.remove('text-[#CBAD8D]');
                    s.classList.remove('scale-125');
                    s.classList.add('text-[#A48374]');
                }
            });
            
            ratingInputs[index].checked = true;
            
            submitBtn.disabled = false;
        });

        star.addEventListener('mouseover', function() {
            if (selectedRating === 0 || (selectedRating > 0 && index < selectedRating)) {
                star.classList.add('text-[#CBAD8D]');
            }
        });

        star.addEventListener('mouseout', function() {
            if (selectedRating === 0 || (selectedRating > 0 && index >= selectedRating)) {
                star.classList.remove('text-[#CBAD8D]');
            }
        });
    });
});
</script>
@endsection