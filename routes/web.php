<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;







Route::get('/', function () {
    return view('home');
})->name('home');

//index
Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');

//create
Route::get('/resources/create', [ResourceController::class, 'create'])->name('resource.create');

//show
Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resource.show');


//store
Route::post('/resources', [ResourceController::class, 'store'])->name('resource.store');

//edit
Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resource.edit');

//update
Route::patch('/resources/{resource}', [ResourceController::class, 'update'])->name('resource.update');

//destroy
Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resource.destroy');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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
