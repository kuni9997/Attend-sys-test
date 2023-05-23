<?php

use App\Http\Controllers\ClockInController;
use App\Http\Controllers\RecordController;
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
Route::get('/dashboard/working', [ClockInController::class, 'workingTimeSt']);
Route::post('/dashboard/working', [ClockInController::class, 'workingTimeEnd'])->middleware('workingTimeEnd');
Route::get('/dashboard/break', [ClockInController::class, 'breakTimeSt'])->middleware('breakTimeSt');
Route::post('/dashboard/break', [ClockInController::class, 'breakTimeEnd'])->middleware('breakTimeEnd');

Route::get('/record', [RecordController::class, 'recordIndex']);