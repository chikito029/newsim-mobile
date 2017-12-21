<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'code' => 'BACOLOD',
            'name' => 'NEWSIM Bacolod',
            'email' => 'bacolod@newsim.ph',
            'address' => '3F LKC Bldg. Locsin-Burgos St. Brgy. 11 Bacolod City 6100',
            'telephone_no' => '(034)4350701',
            'facebook_url' => 'https://www.facebook.com/newsim.bacolod/',
            'photo_url' => '',
        ]);
        Branch::create([
            'code' => 'CEBU',
            'name' => 'NEWSIM Cebu',
            'email' => 'cebu@newsim.ph',
            'address' => '6F 731 Bldg. Escario St. Brgy. Capitol Site, Cebu City 6000',
            'telephone_no' => '(032)5203141 or 5203747',
            'facebook_url' => 'https://www.facebook.com/New.Simulator.CebuBranch',
            'photo_url' => '',
        ]);
        Branch::create([
            'code' => 'DAVAO',
            'name' => 'NEWSIM Davao',
            'email' => 'davao@newsim.ph',
            'address' => '3F Court View Hotel, Pink Waltes Bldg. Quimpo Blvd. Matina Davao City 8000',
            'telephone_no' => '(082)2850224 or +63(912)1084078',
            'facebook_url' => 'https://www.facebook.com/newsim.davao',
            'photo_url' => '',
        ]);
        Branch::create([
            'code' => 'ILO-ILO',
            'name' => 'NEWSIM Ilo-ilo',
            'email' => 'iloilo@newsim.ph',
            'address' => '2F 402 Arguelles Bldg. E. Lopez St. Jaro, Iloilo City 5000',
            'telephone_no' => '(033)3203776',
            'facebook_url' => 'https://www.facebook.com/newsim.iloilo/',
            'photo_url' => '',
        ]);
        Branch::create([
            'code' => 'MAKATI',
            'name' => 'NEWSIM Makati',
            'email' => 'info@newsim.ph',
            'address' => '2323 NEWSIM Bldg. Marconi St. Brgy. San Isidro, Makati City 1234',
            'telephone_no' => '(02)8882764 or 664-8357',
            'facebook_url' => 'https://www.facebook.com/NEWSIM-New-Simulator-Center-of-the-Philippines-Inc-208476015856313/',
            'photo_url' => '',
        ]);
    }
}
