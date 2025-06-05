<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
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

// special routes for the administrator
Route::middleware([RoleMiddleware::class . ':admin', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name("dashboard");

    Route::get('/offers', [\App\Http\Controllers\OffersController::class, 'index'])->name('offers.index');
    Route::get('/offers/create', [\App\Http\Controllers\OffersController::class, 'create'])->name('offers.create');
    Route::post('/offers/store', [\App\Http\Controllers\OffersController::class, 'store'])->name('offers.store');
    Route::get('/offers/{offer}', [\App\Http\Controllers\OffersController::class, 'show'])->name('offers.show');
    Route::get('/offers/{offer}/edit', [\App\Http\Controllers\OffersController::class, 'edit'])->name('offers.edit');
    Route::put('/offers/{offer}', [\App\Http\Controllers\OffersController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{offer}', [\App\Http\Controllers\OffersController::class, 'destroy'])->name('offers.destroy');
});


// route for loged in users
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
    Route::get('/facourites/create', [\App\Http\Controllers\FavouriteController::class, 'create'])->name('favourite.create');
    Route::get('/favourites', [\App\Http\Controllers\FavouriteController::class, 'index'])->name('favourite.index');
});

require __DIR__ . '/auth.php';
