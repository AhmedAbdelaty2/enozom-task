<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHolidayRequest;
use App\Services\HolidayService;

class HolidayController extends Controller
{
    public function getHolidays($countryId){
        return HolidayService::getHolidaysPerCountry($countryId);
    }

    public function store(StoreHolidayRequest $request){

        return HolidayService::insertHoliday($request);
    }

    public function destroy($id){
        return HolidayService::deleteHoliday($id);
    }

    public function update(StoreHolidayRequest $request){
        return HolidayService::updateHoliday($request);
    }
}
