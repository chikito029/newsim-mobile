<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
    $schedules = Schedule::with('branch')->get();
    $schedulesWithBranch = [];

    foreach ($schedules as $schedule) {
        $tempArray = [];
        $tempArray['id'] = $schedule->id;
        $tempArray['course_name'] = $schedule->course_name;
        $tempArray['start_date'] = $schedule->start_date;
        $tempArray['end_date'] = $schedule->end_date;
        $tempArray['start_time'] = $schedule->start_time;
        $tempArray['end_time'] = $schedule->end_time;
        $tempArray['branch_name'] = $schedule->branch->name;
        $schedulesWithBranch[] = $tempArray;
    }

    return $schedulesWithBranch;
});

Route::get('posts', function() {
    $posts = \App\Post::with('branch')->get();
    $postsWithBranch = [];

    foreach ($posts as $post) {
        $tempArray = [];
        $tempArray['id'] = $post->id;
        $tempArray['title'] = $post->title;
        $tempArray['body'] = $post->body;
        $tempArray['branch_name'] = $post->branch->name;
        $postsWithBranch[] = $tempArray;
    }

    return $postsWithBranch;
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

Route::get('exchange-rates', function () {
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.fixer.io/',
        // You can set any number of default request options.
        'timeout'  => 5.0,
    ]);

    $exchange = $client->request('GET', 'latest?base=PHP');

    $exchange = json_decode($exchange->getBody());

    $countryCodes = [
        ['code' => 'AUD', 'name' => 'Australian Dollar'],
        ['code' => 'BGN', 'name' => 'Bulgarian Lev'],
        ['code' => 'BRL', 'name' => 'Brazilian Real'],
        ['code' => 'CAD', 'name' => 'Canadian Dollar'],
        ['code' => 'CHF', 'name' => 'Swiss Franc'],
        ['code' => 'CNY', 'name' => 'Chinese Yuan'],
        ['code' => 'CZK', 'name' => 'Czech Koruna'],
        ['code' => 'DKK', 'name' => 'Danish Krone'],
        ['code' => 'EUR', 'name' => 'Euro'],
        ['code' => 'GBP', 'name' => 'British Pound'],
        ['code' => 'HKD', 'name' => 'Hong Kong Dollars'],
        ['code' => 'HRK', 'name' => 'Croatian Kuna'],
        ['code' => 'HUF', 'name' => 'Hungarian Forint'],
        ['code' => 'IDR', 'name' => 'Indonesian Rupiah'],
        ['code' => 'ILS', 'name' => 'Israeli New Shekel'],
        ['code' => 'INR', 'name' => 'Indian Rupee'],
        ['code' => 'JPY', 'name' => 'Japanese Yen'],
        ['code' => 'KRW', 'name' => 'South Korean Won'],
        ['code' => 'MXN', 'name' => 'Mexican Peso'],
        ['code' => 'MYR', 'name' => 'Malaysian Ringgit'],
        ['code' => 'NOK', 'name' => 'Norwegian Krone'],
        ['code' => 'NZD', 'name' => 'New Zealand Dollar'],
        ['code' => 'PLN', 'name' => 'Polish Zloty'],
        ['code' => 'RON', 'name' => 'Romanian Leu'],
        ['code' => 'RUB', 'name' => 'Russian Ruble'],
        ['code' => 'SEK', 'name' => 'Swedish Krona'],
        ['code' => 'SGD', 'name' => 'Singapore Dollar'],
        ['code' => 'THB', 'name' => 'Thai Baht'],
        ['code' => 'TRY', 'name' => 'Turkish Lira'],
        ['code' => 'USD', 'name' => 'US Dollar'],
        ['code' => 'ZAR', 'name' => 'South African Rand']
    ];

    foreach($exchange->rates as $rate) {
        foreach($countryCodes as &$country) {
            $country['rate'] = $rate;
        }
    }

    return $countryCodes;
});
