<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\HolidayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index(){
        $countries = Http::get('https://restcountries.com/v3.1/all')->json();

        foreach ($countries as $country) {
            if(isset($country['tld'])){
                $updatedCountry = Country::updateOrCreate(
                    ['country_id'=>$country['tld'][0]],
                    ['country_id'=>$country['tld'][0], 'country_name'=>$country['name']['common']],
                );

                HolidayService::insertOrUpdateHolidays($updatedCountry);
            }
        }
               
        return response([
            'message'=>'data has been updated'
        ],200);
    }
}
