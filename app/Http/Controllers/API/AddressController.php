<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Address\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function fetchAllProvinces()
    {
        try {
            $provinces = $this->addressService->fetchAllProvinces();
            return response()->json($provinces);
        } catch (\Exception $err) {
            return abort(500, $err->getMessage());
        }
    }

    public function fetchDistrictsByProvinceId(Request $request)
    {
        try {
            $districts = $this->addressService->fetchDistrictsByProvinceId($request->province_id);
            return response()->json($districts);
        } catch (\Exception $err) {
            return abort(500, $err->getMessage());
        }
    }

    public function fetchSubDistrictsByDistrictId(Request $request)
    {
        try {
            $subDistricts = $this->addressService->fetchSubDistrictsByDistrictId($request->district_id);
            return response()->json($subDistricts);
        } catch (\Exception $err) {
            return abort(500, $err->getMessage());
        }
    }

    public function fetchVillagesBySubDistrictId(Request $request)
    {
        try {
            $villages = $this->addressService->fetchVillagesBySubDistrictId($request->sub_district_id);
            return response()->json($villages);
        } catch (\Exception $err) {
            return abort(500, $err->getMessage());
        }
    }
}
