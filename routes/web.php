<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;

Route::get('/', [HolidayController::class, 'index'])
    ->name('holiday.index');
Route::post('/check-holiday', [HolidayController::class, 'checkHoliday'])
    ->middleware('validatedate')
    ->name('holiday.check');

