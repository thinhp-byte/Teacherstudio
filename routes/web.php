<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Resource;






Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/resources', function () {
    return view('resources', [
        'resources' => Resource::all()
    ]);
})->name('resources');

Route::get('/resources/{id}', function ($id) {
        $resource = Arr::first(Resource::all(), fn($resource) => $resource['id'] == $id);
    return view('resource', [
        'resource' => $resource
    ]);
})->name('resource');


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
