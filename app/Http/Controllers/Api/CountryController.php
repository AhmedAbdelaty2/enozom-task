<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\CountryService;

class CountryController extends Controller
{
    private CountryService $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService();
    }

    public function syncCountries(){
        
        $this->countryService->syncCountries();
               
        return response([
            'message'=>'data has been updated'
        ],200);
    }

    public function getAllCountries($perPage, $currentPage){
        $data = Country::paginate($perPage,['*'],'page', $currentPage);
        return response($data,200);
    }
}
