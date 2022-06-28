<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Holiday;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function getHolidays($countryId){
        return HolidayService::getHolidaysPerCountry($countryId);
    }

    public function store(Request $request){

        return HolidayService::insertHoliday($request);
    }
}
