<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function getHolidays($countryId){
        return HolidayService::getHolidaysPerCountry($countryId);
    }
}
