<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('home');
Route::get('/prestations', [\App\Http\Controllers\PresentationController::class, 'index'])->name('prestations');



// special routes for the administrator
Route::middleware([RoleMiddleware::class . ':admin', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name("dashboard");

    // Users route
    Route::get('/dashboard/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    // Appointments route
    Route::get('/dashboard/appointments', [\App\Http\Controllers\DashAppointmentController::class, 'index'])->name('DashAppointment.index');
    Route::post('/dashboard/appointments/{appointment}/accept', [\App\Http\Controllers\DashAppointmentController::class, 'accept'])->name('DashAppointment.accept');
    Route::get('/dashboard/appointments/{appointment}', [\App\Http\Controllers\DashAppointmentController::class, 'show'])->name('DashAppointment.show');
    Route::delete('/dashboard/appointments/{appointment}', [\App\Http\Controllers\DashAppointmentController::class, 'destroy'])->name('DashAppointment.destroy');
    Route::post('/dashboard/appointments/{appointment}/reject', [\App\Http\Controllers\DashAppointmentController::class, 'reject'])->name('DashAppointment.reject');
    Route::post('/dashboard/appointments/{appointment}/complete', [\App\Http\Controllers\DashAppointmentController::class, 'complete'])->name('DashAppointment.complete');

    // category routes
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

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
    Route::get('/appointments/create/{offer}', [\App\Http\Controllers\AppointmentsController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/store/{offer}', [\App\Http\Controllers\AppointmentsController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [\App\Http\Controllers\AppointmentsController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{appointment}', [\App\Http\Controllers\AppointmentsController::class, 'reschedule'])->name('appointments.reschedule');
    Route::delete('/appointments/{appointment}', [\App\Http\Controllers\AppointmentsController::class, 'destroy'])->name('appointments.destroy');
    Route::post('/appointments/{appointment}/cancel', [\App\Http\Controllers\AppointmentsController::class, 'cancel'])->name('appointments.cancel');
    
    //favourites routes
    Route::get('/facourites/create', [\App\Http\Controllers\FavouriteController::class, 'create'])->name('favourite.create');
    Route::get('/favourites', [\App\Http\Controllers\FavouriteController::class, 'index'])->name('favourite.index');
});

require __DIR__ . '/auth.php';
