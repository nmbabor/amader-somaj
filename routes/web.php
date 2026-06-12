<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{post:slug}', [ActivityController::class, 'show'])->name('activities.show');

Route::get('/photos', [GalleryController::class, 'photos'])->name('gallery.photos');
Route::get('/videos', [GalleryController::class, 'videos'])->name('gallery.videos');

Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');
Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');

Route::get('/donation', [DonationController::class, 'index'])->name('donation.index');
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Authenticated profile (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('posts', Admin\PostController::class);
        Route::resource('categories', Admin\CategoryController::class)->except('show');
        Route::resource('photos', Admin\PhotoController::class)->except('show');
        Route::resource('videos', Admin\VideoController::class)->except('show');
        Route::resource('team-members', Admin\TeamMemberController::class)->except('show');

        Route::resource('members', Admin\MemberController::class)
            ->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::resource('donations', Admin\DonationController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('contacts', Admin\ContactController::class)
            ->only(['index', 'show', 'destroy']);

        Route::get('settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
    });

require __DIR__.'/auth.php';