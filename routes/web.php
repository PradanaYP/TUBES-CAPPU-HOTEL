<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/room/{id}', [HomeController::class, 'show'])->name('room.show');

Route::get('/index', function () {
    return view('index');
});
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/room-selection/{roomTypeId}', [RoomController::class, 'index'])->name('room.selection');
    Route::post('/room-selection', [TransaksiController::class, 'store'])->name('room.book');
    Route::get('/history', [TransaksiController::class, 'index'])->name('room.history');

    Route::get('/payment/{res_id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{res_id}', [PaymentController::class, 'store'])->name('payment.store');

    Route::get('/user-account', [ProfileController::class, 'userAccount'])->name('user.account');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');

});

require __DIR__.'/auth.php';
