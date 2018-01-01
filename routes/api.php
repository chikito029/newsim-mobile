<?php

use Illuminate\Http\Request;
use App\Schedule;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('schedules/calendar', function () {
    $schedules =  Schedule::all();

    $calendar = $schedules->map(function ($schedule, $key) {
        return [
            'id' => $schedule->id,
            'title' => $schedule->course_name,
            'start' => $schedule->start_date,
            'end' => $schedule->end_date,
            'className' => 'red',
        ];
    });

    return $calendar;
});
