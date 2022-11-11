<?php

use Illuminate\Support\Facades\Route;
use App\Models\Family;

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

Route::redirect('/admin/login', '/login')->name('filament.auth.login'); 

// Replaced by Filament
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

 
Route::get('/calendar/{family:ical_uuid}.ics', function (Family $family) {
    return response($family->calendar)
    ->header('Content-Type', 'text/calendar; charset=utf-8');
});

require __DIR__.'/auth.php';
