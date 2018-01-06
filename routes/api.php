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

Route::get('branches', function() {
    $branches = \App\Branch::all();

   return customize_single_level_collection($branches, 'created_at', 'updated_at');
});

Route::get('courses', function() {
    $courses = \App\Course::with('branch')->get();
    $coursesWithBranch = [];

   foreach ($courses as $course) {
       $tempArray = [];
       $tempArray["id"] = $course->id;
       $tempArray["branch_code"] = $course->branch->code;
       $tempArray["branch_name"] = $course->branch->name;
       $tempArray["branch_telephone_no"] = $course->branch->telephone_no;
       $tempArray["branch_address"] = $course->branch->address;
       $tempArray["branch_facebook_url"] = $course->branch->facebook_url;
       $tempArray["letter"] = strtolower( substr($course->code, 0, 1));
       $tempArray["code"] = $course->code;
       $tempArray["description"] = $course->description;
       $tempArray["category"] = $course->category;
       $tempArray["duration"] = $course->duration;
       $coursesWithBranch[] = $tempArray;
   }

   return $coursesWithBranch;
});
