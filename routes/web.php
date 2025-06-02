<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prestations', function () {
    return view('prestations');
});
Route::get('/reservation', function () {
    return view('reservation');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Appointments routes
    Route::get('/user-dashboard', [\App\Http\Controllers\UserDashboardController::class, 'index'])->name('userDashboard');
    Route::get('/appointments', [\App\Http\Controllers\AppointmentsController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [\App\Http\Controllers\AppointmentsController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [\App\Http\Controllers\AppointmentsController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [\App\Http\Controllers\AppointmentsController::class, 'show'])->name('appointments.show');

    //favourites routes
    Route::get('/facourites', [\App\Http\Controllers\FavouriteController::class, 'index'])->name('favourite.index');
    Route::get('/facourites/create', [\App\Http\Controllers\FavouriteController::class, 'create'])->name('favourite.create');
});

require __DIR__ . '/auth.php';
