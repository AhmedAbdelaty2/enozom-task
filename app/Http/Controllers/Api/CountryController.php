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
                $addCountry = Country::updateOrCreate(
                    ['country_id'=>$country['tld'][0]],
                    ['country_id'=>$country['tld'][0], 'country_name'=>$country['name']['common']],
                );
            }
        }
        

        // $holidays = Http::get('https://www.googleapis.com/calendar/v3/calendars/en.mk%23holiday%40group.v.calendar.google.com/events?key=AIzaSyBpSZoCr4xUGsNzmAuxVw_WT0Q4hVW9Bos');
        
        // return HolidayService::insertOrUpdateHolidays('.uk');
        return response([
            'message'=>'data has been updated'
        ],200);
    }
}
