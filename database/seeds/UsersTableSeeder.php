<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'it.danielbajana@gmail.com',
            'name' => 'Daniel Bajana',
            'branch_id' => 1,
        ]);
    }
}
