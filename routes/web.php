<?php

use App\Http\Controllers\ProfileController;
use App\Models\Family;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\URL::forceScheme('https');

// from https://github.com/spatie/laravel-mail-preview
if (App::environment('local')) {
    Route::mailPreview();
}

Route::redirect('/admin/login', '/login')->name('filament.auth.login');

Route::get('/calendar/{family:ical_uuid}.ics', function (Family $family) {
    return response($family->calendar)
    ->header('Content-Type', 'text/calendar; charset=utf-8');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
