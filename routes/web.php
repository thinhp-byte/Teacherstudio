<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateResource;
use App\Models\Resource;
use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    $resource = Resource::first();
    TranslateResource::dispatch($resource);
    return 'It works!';
});



Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact')->name('contact');

Route::get('/resources', [ResourceController::class, 'index']);
Route::get('/resources/create', [ResourceController::class, 'create'])->middleware('auth');
Route::post('/resources', [ResourceController::class, 'store'])->middleware('auth');
Route::get('/resources/{resource}', [ResourceController::class, 'show']);
Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'resource');

Route::patch('/resources/{resource}', [ResourceController::class, 'update'])->middleware('auth');
Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->middleware('auth');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
