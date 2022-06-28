<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    private HolidayService $holidayService;

    public function __construct()
    {
        $this->holidayService = new HolidayService();
    }

    public function syncHolidays(){
        return $this->holidayService->syncHolidaysRemotely();
    }

    public function getHolidays($countryId){
        return $this->holidayService->getHolidaysPerCountry($countryId);
    }

    public function store(StoreHolidayRequest $holiday){
        return $this->holidayService->insertHoliday($holiday);
    }

    public function destroy($id){
        return $this->holidayService->deleteHoliday($id);
    }

    public function update(UpdateHolidayRequest $holiday){
        return $this->holidayService->updateHoliday($holiday);
    }
}
