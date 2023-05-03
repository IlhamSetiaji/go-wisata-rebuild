<?php

namespace App\Http\Controllers;

use App\Services\Address\AddressService;
use App\Services\Tour\TourService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TourController extends Controller
{
    private $tourService;
    private $userService;
    private $addressService;

    public function __construct(TourService $tourService, UserService $userService, AddressService $addressService)
    {
        $this->tourService = $tourService;
        $this->userService = $userService;
        $this->addressService = $addressService;
    }

    public function index()
    {
        try {
            $users = $this->userService->whereHasRoleIn('name',['admin','admin-tour']);
            $tours = $this->tourService->getAllTours();
            $provinces = $this->addressService->fetchAllProvinces();
            if (request()->ajax()) {
                $view = view('tours.data', compact('tours'))->render();

                return response()->json(['html' => $view]);
            }
            return view('tours.index', compact('tours', 'users', 'provinces'));
        } catch (\Exception $err) {
            return abort(500, $err->getMessage());
        }
    }
}
