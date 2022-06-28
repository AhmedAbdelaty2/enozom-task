<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\CountryService;

use function PHPSTORM_META\map;

class CountryController extends Controller
{
    public function index(){
        
        CountryService::syncCountries();
               
        return response([
            'message'=>'data has been updated'
        ],200);
    }

    public function getAllCountries(){
        $data = Country::paginate(50);
        return response($data,200);
    }
}
