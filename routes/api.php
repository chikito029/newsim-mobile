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
       $tempArray["accredited_by"] = $course->accredited_by;
       $tempArray["duration"] = $course->duration;
       $coursesWithBranch[] = $tempArray;
   }

   return $coursesWithBranch;
});

Route::get('offices', function() {
    return customize_single_level_collection(\App\Office::all(), 'created_at', 'updated_at');
});

Route::get('schedules', function() {
    return customize_single_level_collection(\App\Schedule::all(), 'created_at', 'updated_at');
});

Route::get('posts', function() {
    return customize_single_level_collection(\App\Post::all(), 'created_at', 'updated_at');
});

Route::get('post-images', function() {
    return customize_single_level_collection(\App\PostImage::all(), 'created_at', 'updated_at');
});

Route::get('promos', function() {
    $promos = \App\Promo::with('branch')->orderBy('created_at', 'desc')->get();
    $promosWithBranch = [];

    foreach ($promos as $promo) {
        $tempArray = [];
        $tempArray["id"] = $promo->id;
        $tempArray["title"] = $promo->title;
        $tempArray["body"] = $promo->body;
        $tempArray["banner_url"] = $promo->banner_url;
        $tempArray["start_date"] = $promo->start_date;
        $tempArray["end_date"] = $promo->end_date;
        $tempArray["branch"] = $promo->branch->name;
        $promosWithBranch[] = $tempArray;
    }

    return $promosWithBranch;
});

Route::get('promo-courses', function() {
    return customize_single_level_collection(\App\PromoCourse::all(), 'created_at', 'updated_at');
});
