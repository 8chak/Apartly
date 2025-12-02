<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingsController;

Route::get('/', [HomeController::class, 'hotel_index'])->name('hotel');
Route::get('/room-details/{room}', [HomeController::class, 'show_room'])->name('room_details');
Route::get('/all-rooms', [HomeController::class, 'all_rooms'])->name('all_rooms');
Route::get('/blogs', [HomeController::class, 'blogpage'])->name('blog_page');
Route::get('/blogs/{id}', [HomeController::class, 'viewPost'])->name('view_post');
Route::POST('/contact', [HomeController::class, 'store_message'])->name('contact_message');
Route::get('/contact', [HomeController::class, 'contact_page'])->name('contact_page');
Route::POST('/booking', [BookingsController::class, 'store'])->name('add_booking');

Route::middleware( ['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/bookings', [AdminController::class, 'index_bookings'])->name('bookingsList');
    Route::PATCH('/admin/bookings/{booking}/update', [AdminController::class, 'update_booking'])->name('update_booking_status');
});

//Add-Middleware-Admin
Route::get('/admin/rooms', [AdminController::class, 'rooms_index'])->name('roomsIndex');
Route::get('/admin/create-room', [AdminController::class, 'create_room'])->name('addRoom');
Route::POST('/admin/create-room', [AdminController::class, 'store_room'])->name('storeRoom');
Route::get('/admin/edit-room/{room}', [AdminController::class, 'edit_room'])->name('edit_room');
Route::put('/admin/update-room/{room}', [AdminController::class, 'update_room'])->name('update_room');
Route::delete('/admin/rooms/{room}', [AdminController::class, 'destroy_room'])->name('delete_room');
//
Route::get('/admin/posts', [AdminController::class, 'posts_index'])->name('admin.posts.index');
Route::get('/admin/posts/edit/{blog}', [AdminController::class, 'posts_edit'])->name('admin.posts.edit');
Route::PATCH('/admin/posts/{blog}/update', [AdminController::class, 'post_update'])->name('admin.posts.update');
Route::DELETE('/admin/posts/{blog}/destroy', [AdminController::class, 'post_destroy'])->name('admin.posts.destroy');
Route::get('/admin/create-post', [AdminController::class, 'create_post'])->name('create_post');
Route::POST('/admin/create-post', [AdminController::class, 'create_post_store'])->name('create_post_store');

//
Route::get('/admin/gallery', [AdminController::class, 'index_gallery'])->name('hotel_gallery');
Route::POST('/admin/gallery', [AdminController::class, 'store_gallery'])->name('store_gallery');
Route::delete('/gallery/${selectedImageId}', [AdminController::class, 'gallery_destroy'])->name('delete_gallery');
//
Route::get('/admin/messages', [AdminController::class, 'messages_index'])->name('admin.messages.index');
