<?php

namespace App\Http\Controllers;

use App\Services\Tour\TourService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TourController extends Controller
{
    private $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }

    public function index()
    {
        try {
            $tours = $this->tourService->getAllTours();
            if (request()->ajax()) {
                $view = view('tours.data', compact('tours'))->render();

                return response()->json(['html' => $view]);
            }
            return view('tours.index', compact('tours'));
        } catch (\Exception $err) {
            return abort(500, $err->getMessage());
        }
    }
}
