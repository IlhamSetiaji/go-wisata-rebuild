<?php

namespace App\Services\Address;

use Illuminate\Support\Facades\Http;
use LaravelEasyRepository\Service;

class AddressServiceImplement extends Service implements AddressService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    // Define your custom methods :)

    public function fetchAllProvinces(): array
    {
        $provinces = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        return json_decode($provinces)->provinsi;
    }

    public function fetchDistrictsByProvinceId(int $provinceId): array
    {
        $districts = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . $provinceId);
        return json_decode($districts)->kota_kabupaten;
    }

    public function fetchSubDistrictsByDistrictId(int $districtId): array
    {
        $subDistricts = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' . $districtId);
        return json_decode($subDistricts)->kecamatan;
    }

    public function fetchVillagesBySubDistrictId(int $subDistrictId): array
    {
        $villages = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=' . $subDistrictId);
        return json_decode($villages)->kelurahan;
    }
}
