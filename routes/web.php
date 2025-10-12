<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\ResourceController;
use App\Jobs\TranslateResource;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    $resource = Resource::first();
    TranslateResource::dispatch($resource);
    return 'It works!';
});



Route::view('/', 'home')->name('home');

Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');


Route::middleware('auth')->group(function () {
    Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::patch('/resources/{resource}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');
});

Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/profiles/{user}', function (User $user) {
    $profile = $user->teacherProfile;
    
    if (!$profile) {
        abort(404, 'Teacher profile not found');
    }
    
    return view('profiles.show', [
        'user' => $user,
        'profile' => $profile
    ]);
})->name('profiles.show');


require __DIR__.'/auth.php';
