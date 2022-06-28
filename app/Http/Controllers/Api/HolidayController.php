<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHolidayRequest;
use App\Services\HolidayService;

class HolidayController extends Controller
{
    private HolidayService $holidayService;

    public function __construct()
    {
        $this->holidayService = new HolidayService();
    }

    public function syncHolidays($countryId){
        return $this->holidayService->syncHolidaysRemotely($countryId);
    }

    public function getHolidays($countryId){
        return $this->holidayService->getHolidaysPerCountry($countryId);
    }

    public function store(StoreHolidayRequest $request){
        return $this->holidayService->insertHoliday($request);
    }

    public function destroy($id){
        return $this->holidayService->deleteHoliday($id);
    }

    public function update(StoreHolidayRequest $request){
        return $this->holidayService->updateHoliday($request);
    }
}
