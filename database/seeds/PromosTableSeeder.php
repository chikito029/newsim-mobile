<?php

use Illuminate\Database\Seeder;
use App\Promo;
use App\PromoCourse;

class PromosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Promo::class, 6)->create()->each(function ($promo) {
            for ($i=0; $i < rand(0, 14); $i++) {
                $promo->promoCourses()->save(factory(PromoCourse::class)->make());
            }
        });
    }
}
