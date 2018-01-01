<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->username,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'branch_id' => rand(1, 5),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'branch_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'created_by' => 1,
    ];
});

$factory->define(App\PostImage::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->imageUrl($width = 640, $height = 480),
        'width' => 640,
        'height' => 480,
    ];
});

$factory->define(App\Promo::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'banner_url' => $faker->imageUrl($width = 640, $height = 480),
        'start_date' => $faker->dateTime($max = 'now', $timezone = null),
        'end_date' => $faker->dateTime($max = 'now', $timezone = null),
        'branch_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'created_by' => 1,
    ];
});

$factory->define(App\PromoCourse::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 50000),
    ];
});

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {

    $courses = App\Course::all();

    $randomDate = $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d');
    $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $randomDate)->addDay(rand(0, 5))->format('Y-m-d');

    return [
        'course_name' => $courses[rand(1, $courses->count())]->code,
        'start_date' => $randomDate,
        'end_date' => $endDate,
        'start_time' => $faker->time($format = 'H:i:s', $max = 'now'),
        'end_time' => $faker->time($format = 'H:i:s', $max = 'now'),
        'branch_id' => $faker->randomElement([1,2,3,4,5]),
        'created_by' => 1,
    ];
});
