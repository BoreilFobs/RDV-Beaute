<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('home');
Route::get('/prestations', [\App\Http\Controllers\PresentationController::class, 'index'])->name('prestations');
Route::post('/messages/send', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');



// special routes for the administrator
Route::middleware([RoleMiddleware::class . ':admin', 'auth'])->group(function () {
    // dashboard route
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name("dashboard");

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

    // offers route
    Route::get('/offers', [\App\Http\Controllers\OffersController::class, 'index'])->name('offers.index');
    Route::get('/offers/create', [\App\Http\Controllers\OffersController::class, 'create'])->name('offers.create');
    Route::post('/offers/store', [\App\Http\Controllers\OffersController::class, 'store'])->name('offers.store');
    Route::get('/offers/{offer}', [\App\Http\Controllers\OffersController::class, 'show'])->name('offers.show');
    Route::get('/offers/{offer}/edit', [\App\Http\Controllers\OffersController::class, 'edit'])->name('offers.edit');
    Route::put('/offers/{offer}', [\App\Http\Controllers\OffersController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{offer}', [\App\Http\Controllers\OffersController::class, 'destroy'])->name('offers.destroy');

    // stock routes
    Route::get('/stock', [\App\Http\Controllers\StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/create', [\App\Http\Controllers\StockController::class, 'create'])->name('stock.create');
    Route::post('/stock/store', [\App\Http\Controllers\StockController::class, 'store'])->name('stock.store');
    Route::get('/stock/{stock}', [\App\Http\Controllers\StockController::class, 'show'])->name('stock.show');
    Route::get('/stock/{stock}/edit', [\App\Http\Controllers\StockController::class, 'edit'])->name('stock.edit');
    Route::put('/stock/{stock}', [\App\Http\Controllers\StockController::class, 'update'])->name('stock.update');
    Route::delete('/stock/{stock}', [\App\Http\Controllers\StockController::class, 'destroy'])->name('stock.destroy');
    Route::post('admin/stock/{stock}/used', [\App\Http\Controllers\StockController::class, 'used'])->name('stock.used');

    // messages routes
    Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{message}', [\App\Http\Controllers\MessageController::class, 'destroy'])->name('messages.destroy');
    Route::post('/messages/{message}', [\App\Http\Controllers\MessageController::class, 'markAsRead'])->name('messages.markAsRead');

    // gallery routes
    Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [\App\Http\Controllers\GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [\App\Http\Controllers\GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}', [\App\Http\Controllers\GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/gallery/{gallery}/edit', [\App\Http\Controllers\GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{gallery}', [\App\Http\Controllers\GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [\App\Http\Controllers\GalleryController::class, 'destroy'])->name('gallery.destroy');
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
