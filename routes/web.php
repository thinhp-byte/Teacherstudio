<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\ResourceController;
use App\Jobs\TranslateResource;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\TeacherController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\CollectionController;


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

    Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'destroy'])->name('users.unfollow');

    Route::get('/profile/setup', [TeacherProfileController::class, 'create'])
        ->name('profile.setup');
    Route::post('/profile', [TeacherProfileController::class, 'store'])
        ->name('profile.store');
    Route::get('/profile/edit', [TeacherProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [TeacherProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/collections', [CollectionController::class, 'index'])
        ->name('collections.index');
    Route::get('/collections/create', [CollectionController::class, 'create'])
        ->name('collections.create');
    Route::post('/collections', [CollectionController::class, 'store'])
        ->name('collections.store');
    Route::get('/collections/{id}', [CollectionController::class, 'show'])
        ->name('collections.show');
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

Route::get('/teachers', [App\Http\Controllers\TeacherController::class, 'index'])->name('teachers.index');


require __DIR__.'/auth.php';
