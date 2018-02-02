<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Schedule;
use Illuminate\Support\Facades\File;

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
            'start' => Carbon::parse($schedule->start_date)->timestamp,
            'end' => Carbon::parse($schedule->end_date)->timestamp,
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
       $tempArray["code"] = $course->code;
       $tempArray["description"] = $course->description;
       $tempArray["category"] = $course->category;
       $tempArray["aims"] = $course->aims;
       $tempArray["objectives_header"] = $course->objectives_header;
       $tempArray["objectives"] = $course->objectives;
       $tempArray["target_audience"] = $course->target_audience;
       $tempArray["delegate_prerequisites"] = $course->delegate_prerequisites;
       $tempArray["accredited_by"] = $course->accredited_by;
       $tempArray["duration"] = $course->duration;
       $tempArray["validity"] = $course->validity;
       $coursesWithBranch[] = $tempArray;
   }

   return $coursesWithBranch;
});

Route::get('offices', function() {
    $officesRaw = \App\Office::all();
    $offices = [];

    foreach($officesRaw as $office) {
        $tempArray = [];
        $tempArray['name'] = $office->name;
        $tempArray['email'] = $office->email;
        $tempArray['address'] = $office->address;
        $tempArray['telephone_no'] = $office->telephone_no;
        $tempArray['location'] = $office->location;
//        $tempArray['photo_base64_image'] = base64_encode(File::get(public_path() .'\\'. str_replace('/', '\\', $office->photo_url))); // used for windows
        $tempArray['photo_base64_image'] = base64_encode(File::get(public_path() .'/'. str_replace('\\', '/', $office->photo_url))); // used for mac
        $offices[] = $tempArray;
    }

    return $offices;
});

Route::get('schedules', function() {
    $schedules = Schedule::with('branch')->get();
    $schedulesWithBranch = [];

    foreach ($schedules as $schedule) {
        $tempArray = [];
        $tempArray['id'] = $schedule->id;
        $tempArray['course_name'] = $schedule->course_name;
        $tempArray['start_date'] = Carbon::parse($schedule->start_date)->timestamp;
        $tempArray['end_date'] = Carbon::parse($schedule->end_date)->timestamp;
        $tempArray['start_time'] = Carbon::parse($schedule->start_time)->timestamp;
        $tempArray['end_time'] = Carbon::parse($schedule->end_time)->timestamp;
        $tempArray['branch_name'] = $schedule->branch->name;
        $schedulesWithBranch[] = $tempArray;
    }

    return $schedulesWithBranch;
});

Route::get('posts', function(Request $request) {

    $lastItemId = $request->last_item_id;
    $postType = $request->post_type;
    $posts = null;

    if ($postType == "new") {
        $posts = \App\Post::with('branch', 'postImages')->where('id' , '>', $lastItemId)->take(5)->get();
    } elseif ($postType == "old") {
        $posts = \App\Post::with('branch', 'postImages')->where('id' , '<', $lastItemId)->orderBy('id', 'desc')->take(5)->get();
    }

    $postsWithBranch = [];

    foreach ($posts as $post) {
        $tempArray = [];
        $tempArray['id'] = $post->id;
        $tempArray['title'] = $post->title;
        $tempArray['body'] = $post->body;
        $tempArray['branch_name'] = $post->branch->name;
//        $tempArray['post_cover_url'] = public_path() .'\\'. str_replace('/', '\\', $post->postImages->first()->url); // used for windows
        $tempArray['post_cover_url'] = public_path() .'/'. str_replace('\\', '/', $post->postImages->first()->url); // used for mac
//        $tempArray['post_cover_base64_image'] = count($post->postImages) < 1 ? null : base64_encode(File::get(public_path() .'\\'. str_replace('/', '\\', $post->postImages->first()->url))); // used for windows
        $tempArray['post_cover_base64_image'] = count($post->postImages) < 1 ? null : base64_encode(File::get(public_path() .'/'. str_replace('\\', '/', $post->postImages->first()->url))); // used for mac
        $tempArray['created_at'] = $post->created_at->timestamp;
        $postsWithBranch[] = $tempArray;
    }

    return $postsWithBranch;
});

Route::get('post-images', function() {
    $postImagesRaw = \App\PostImage::all();

    $postImages = [];

    // encode image to base64 for easy database manipulation
    foreach ($postImagesRaw as $postImage) {
//        $postImages[] = ['post_id' => $postImage->post_id, 'base64_image' => base64_encode(File::get(public_path() .'\\'. str_replace('/', '\\', $postImage->url)))]; // used for windows
        $postImages[] = ['post_id' => $postImage->post_id, 'base64_image' => base64_encode(File::get(public_path() .'/'. str_replace('\\', '/', $postImage->url)))]; // used for mac
    }

    return $postImages;
});

Route::get('promos', function() {
    $promos = \App\Promo::with('branch')->orderBy('created_at', 'desc')->get();

    if ($promos) {
        $promosWithBranch = [];

        foreach ($promos as $promo) {
            $tempArray = [];
            $tempArray["id"] = $promo->id;
            $tempArray["title"] = $promo->title;
            $tempArray["body"] = $promo->body;
//            $tempArray["banner_base64_image"] = public_path() .'\\'. str_replace('/', '\\', $promo->banner_url); // used for windows
            $tempArray["banner_base64_image"] = public_path() .'/'. str_replace('\\', '/', $promo->banner_url); // used for mac
            $tempArray["start_date"] = Carbon::parse($promo->start_date)->timestamp;
            $tempArray["end_date"] = Carbon::parse($promo->end_date)->timestamp;
            $tempArray["branch"] = $promo->branch->name;
            $promosWithBranch[] = $tempArray;
        }

        return $promosWithBranch;
    } elseif (! $promos) {
        return null;
    }
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
