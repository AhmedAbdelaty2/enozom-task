<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\CountryService;
use App\Services\HolidayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
