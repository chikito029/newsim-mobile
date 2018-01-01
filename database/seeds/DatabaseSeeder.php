<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BranchesTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        // $this->call(PromosTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
    }
}
