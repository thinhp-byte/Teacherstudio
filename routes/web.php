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
    $resources=resource::with("collection")->simplepaginate(3);
    return view('resources.index', [
        'resources' => $resources
    ]);
})->name('resources.index');


Route::get('/resources/create', function () {
    return view('resources.create');
})->name('resource.create');

Route::get('/resources/{id}', function ($id) {
    $resource = Resource::find($id);
    return view('resources.show', [
        'resource' => $resource
    ]);
})->name('resource.show');




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
