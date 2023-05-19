<?php

use App\Http\Controllers\BreakTimeController;
use App\Http\Controllers\WorkingController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


//下記が追加で記述したルーティング
Route::get('/dashboard/WorkingSt', [WorkingController::class, 'start'])->middleware('Attendance');
Route::get('/dashboard/BreakingSt', [BreakTimeController::class, 'start']);