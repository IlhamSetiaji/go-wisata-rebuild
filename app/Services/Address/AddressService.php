<?php

namespace App\Services\Address;

use LaravelEasyRepository\BaseService;

interface AddressService extends BaseService
{

    // Write something awesome :)
    public function fetchAllProvinces(): array;
    public function fetchDistrictsByProvinceId(int $provinceId): array;
    public function fetchSubDistrictsByDistrictId(int $districtId): array;
    public function fetchVillagesBySubDistrictId(int $subDistrictId): array;
}
