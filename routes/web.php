<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// user
Route::middleware(['auth'])->group(function () {
    // booking
    Route::prefix('booking')->group(function () {
        Route::get('/check', [BookingController::class, 'checkAvailability'])->name('booking.check');
        Route::get('/{roomType}/create', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('booking.my-bookings');
    });

    // review
    Route::prefix('booking/{booking}')->group(function () {
        Route::get('/review', [ReviewController::class, 'create'])->name('review.create');
        Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    });
});

// admin
Route::middleware(['auth', 'verified', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // room
    Route::prefix('rooms')->group(function () {
        Route::get('/', [AdminController::class, 'manageRooms'])->name('admin.rooms.index');
        Route::get('/create', [AdminController::class, 'createRoomType'])->name('admin.rooms.create');
        Route::post('/', [AdminController::class, 'storeRoomType'])->name('admin.rooms.store');
        Route::get('/{roomType}/edit', [AdminController::class, 'editRoomType'])->name('admin.rooms.edit');
        Route::put('/{roomType}', [AdminController::class, 'updateRoomType'])->name('admin.rooms.update');
        Route::get('/{roomType}/list', [AdminController::class, 'manageRoomList'])->name('admin.rooms.list');
        Route::post('/{roomType}/add', [AdminController::class, 'addRoom'])->name('admin.rooms.add');
        Route::post('/{room}/status', [AdminController::class, 'updateRoomStatus'])->name('admin.rooms.status');
    });

    // booking
    Route::prefix('bookings')->group(function () {
        Route::get('/', [AdminController::class, 'manageBookings'])->name('admin.bookings.index');
        Route::post('/{booking}/status/{status}', [AdminController::class, 'updateBookingStatus'])->name('admin.bookings.status');
    });

    // review
    Route::prefix('reviews')->group(function () {
        Route::get('/', [AdminController::class, 'manageReviews'])->name('admin.reviews.index');
        Route::post('/{review}/reply', [AdminController::class, 'replyToReview'])->name('admin.reviews.reply');
        Route::delete('/admin/reviews/{review}', [AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
    });

    // hotel info
    Route::prefix('hotel-info')->group(function () {
        Route::get('/', [AdminController::class, 'hotelInfo'])->name('admin.hotel-info');
        Route::post('/', [AdminController::class, 'updateHotelInfo'])->name('admin.hotel-info.update');
    });
});