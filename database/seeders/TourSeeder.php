<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i < 10; $i++) {
            $province = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi/' . 10 + $i);
            $city = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . json_decode($province)->id);
            $district = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' . json_decode($city)->kota_kabupaten[0]->id);
            $subDistrict = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=' . json_decode($district)->kecamatan[0]->id);
            $location = json_decode(Http::get('https://randomuser.me/api/'))->results[0]->location;
            for($j = 1; $j <= 3; $j++){
                $tour = [
                    'name' => 'Tour ' . $i . ' ' . $j,
                    'description' => 'Description ' . $i . ' ' . $j,
                    'latitude' => '-7.3387896',
                    'longitude' => '112.7301445',
                    'province_id' => json_decode($province)->id,
                    'province_name' => json_decode($province)->nama,
                    'city_id' => json_decode($city)->kota_kabupaten[0]->id,
                    'city_name' => json_decode($city)->kota_kabupaten[0]->nama,
                    'district_id' => json_decode($district)->kecamatan[0]->id,
                    'district_name' => json_decode($district)->kecamatan[0]->nama,
                    'sub_district_id' => json_decode($subDistrict)->kelurahan[0]->id,
                    'sub_district_name' => json_decode($subDistrict)->kelurahan[0]->nama,
                    'address' => $location->street->number . ' ' . $location->street->name,
                    'postal_code' => $location->postcode,
                    'phone' => rand(1000000000, 9999999999),
                ];
                $tour['slug'] = Str::slug($tour['name']);
                \App\Models\User::find(1)->tours()->create($tour);
            }
        }
    }
}
