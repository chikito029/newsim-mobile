<?php

use Illuminate\Database\Seeder;
use App\Office;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::create([
            "name" => "NEWSIM Bacolod",
            "email" => "bacolod@newsim.ph",
            "address"=> "3F LKC Bldg. Locsin-Burgos St. Brgy. 11 Bacolod City 6100",
            "telephone_no" => "(034)4350701",
            "location" => "geo:10.671450, 122.949501?q=10.671450, 122.949501(NEWSIM BACOLOD)&z=18",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_bacolod.jpg",
        ]);
        Office::create([
            "name" => "NEWSIM Cebu",
            "email" => "cebu@newsim.ph",
            "address"=> "6F 731 Bldg. Escario St. Brgy. Capitol Site, Cebu City 6000",
            "telephone_no" => "(032)5203141 or 5203747",
            "location" => "geo:10.316989, 123.892501?q=NEWSIM+CEBU",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_cebu.jpg",
        ]);
        Office::create([
            "name" => "NEWSIM Cebu Annex Capitol Square",
            "email" => "cebu@newsim.ph",
            "address"=> "3F Capitol Square, Escario St. Brgy. Capitol Site, Cebu City 6000",
            "telephone_no" => "(032)5203141 or 5203747",
            "location" => "geo:10.3169110, 123.8938355?q=10.3169110, 123.8938355(NEWSIM CEBU Annex)&z=18",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_cebu_annex.jpg",
        ]);
        Office::create([
            "name" => "NEWSIM Cebu Practical Site",
            "email" => "cebu@newsim.ph",
            "address"=> "Zone 2, Brgy. Biasong, Talisay City",
            "telephone_no" => "(032)5203141 or 5203747",
            "location" => "geo:10.236360, 123.829362?q=NEWSIM+CEBU+Practical+Site",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_talisay.jpg",
        ]);
        Office::create([
            "name" => "NEWSIM Davao",
            "email" => "davao@newsim.ph",
            "address"=> "3F Court View Hotel, Pink Waltes Bldg. Quimpo Blvd. Matina Davao City 8000",
            "telephone_no" => "(082)2850224 or +63(912)1084078",
            "location" => "geo:7.057441, 125.600810?q=NEWSIM+DAVAO",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_davao.png",
        ]);
        Office::create([
            "name" => "NEWSIM Ilo-ilo",
            "email" => "iloilo@newsim.ph",
            "address"=> "2F 402 Arguelles Bldg. E. Lopez St. Jaro, Iloilo City 5000",
            "telephone_no" => "(033)3203776",
            "location" => "geo:10.721861, 122.558733?q=NEWSIM+ILOILO",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_iloilo.png",
        ]);
        Office::create([
            "name" => "NEWSIM Makati Marconi",
            "email" => "info@newsim.ph",
            "address"=> "2323 NEWSIM Bldg. Marconi St. Brgy. San Isidro, Makati City 1234",
            "telephone_no" => "(02)8882764 or 664-8357",
            "location" => "geo:14.554677, 121.001053?q=NEWSIM+MARCONI",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_marconi.jpg",
        ]);
        Office::create([
            "name" => "NEWSIM Makati Edison",
            "email" => "info@newsim.ph",
            "address"=> "5F 2053 Bldg. Edison St. Brgy. San Isidro, Makati City 1234",
            "telephone_no" => "(02)8882764 or 664-8357",
            "location" => "geo:14.553635, 121.003397?q=New+Simulator+Center+Of+The+Phils.+Inc)",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_makati.png",
        ]);
        Office::create([
            "name" => "NEWSIM TRAINING ACADEMY",
            "email" => "info@newsim.ph",
            "address"=> "Monte Vista Beach Resort Brgy. Bignay 2 Sariaya Quezon 4322",
            "telephone_no" => "(02)2451195 or 8884544",
            "location" => "geo:13.840336, 121.473373?q=Newsim+Training+Academy,+Quezon+Eco+Tourism+Road,+Sariaya,+Calabarzon",
            "photo_url" => "http://104.238.96.209/~newsimtms/mobile/uploads/cover_nta.jpg",
        ]);
    }
}
