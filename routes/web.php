<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Resource;






Route::get('/', function () {
    return view('home');
})->name('home');

//index
Route::get('/resources', function () {
    $resources=resource::with("collection")->latest()->simplepaginate(3);
    return view('resources.index', [
        'resources' => $resources
    ]);
})->name('resources.index');

//create
Route::get('/resources/create', function () {
    return view('resources.create');
})->name('resource.create');

//show
Route::get('/resources/{resource}', function (Resource $resource) {
    // $resource = Resource::find($id);
    return view('resources.show', [
        'resource' => $resource
    ]);
})->name('resource.show');

//store
Route::post('/resources', function(){
   request()->validate([
    'title'=>['required','min:3'],
    'subject'=>'required',
    'grade'=>'required'
   ]);

   resource::create([
    'collection_id'=>1,
    'title'=>request('title'),
    'subject'=>request('subject'),
    'grade'=>request('grade')
   ]);
    return redirect('/resources');
});

//edit
Route::get('/resources/{resource}/edit', function (Resource $resource) {
    return view('resources.edit', [
        'resource' => $resource
    ]);
})->name('resource.edit');

//update
Route::patch('/resources/{resource}', function (Resource $resource) {
     request()->validate([
    'title'=>['required','min:3'],
    'subject'=>'required',
    'grade'=>'required'
   ]);

    $resource->update([
        'title'=>request('title'),
        'subject'=>request('subject'),
        'grade'=>request('grade')
    ]);
    return redirect('/resources/'.$resource->id);
})->name('resource.update');

//destroy
Route::delete('/resources/{resource}', function (Resource $resource) {
    $resource->delete();
    return redirect('/resources');
})->name('resource.delete');


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
