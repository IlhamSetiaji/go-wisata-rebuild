<?php

namespace App\Services\Tour;

use LaravelEasyRepository\Service;
use App\Repositories\Tour\TourRepository;

class TourServiceImplement extends Service implements TourService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(TourRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)

    public function getAllTours(){
        $user = request()->user();
        if($user->hasRole('admin')){
            return $this->mainRepository->paginateTours();
        }
        return $this->mainRepository->findByAndPaginate('user_id',$user->id);
    }
}
