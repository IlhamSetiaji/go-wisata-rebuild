<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Tour\TourService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use App\Services\Address\AddressService;
use App\Http\Requests\Tour\CreateTourRequest;

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

    public function create(CreateTourRequest $createTourRequest)
    {
        try {
            $payload = $createTourRequest->validated();
            $payload['slug'] = Str::slug($payload['name'], '-');
            $this->tourService->create($payload);
            return redirect()->back()->with('success', 'Tour created successfully');
        } catch (\Exception $err) {
            return abort(400, $err->getMessage());
        }
    }

    public function detail(int $id)
    {
        try {
            $tour = $this->tourService->find($id);
            $location[] = [
                $tour->name,
                $tour->latitude,
                $tour->longitude,
                $tour->id
            ];
            return view('tours.detail', compact('tour','location'));
        } catch (\Exception $err) {
            return abort(400, $err->getMessage());
        }
    }
}
