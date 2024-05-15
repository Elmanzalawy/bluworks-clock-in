<?php

use App\Http\Controllers\ClockInController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('worker')->as('api.worker.')->group(function () {
    Route::post('clock-in', [ClockInController::class, 'clockInWorker'])->name('clockInWorker');
    Route::get('clock-ins', [ClockInController::class, 'getClockIns'])->name('getClockIns');
});
