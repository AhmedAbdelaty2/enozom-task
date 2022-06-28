<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Holiday;
use Illuminate\Support\Facades\Http;

class HolidayService
{
    public function syncHolidaysRemotely($countryId){
        $holidays =  HolidayService::getAllHolidays($countryId);
        if(isset($holidays['items'])){
            $holidays = $holidays['items'];
            foreach($holidays as $holiday){
                $updatedHoliday = Holiday::updateOrCreate(
                        [
                            'holiday_id'=>$holiday['id']
                        ],
                        [
                            'summary'=>$holiday['summary'], 
                            'start'=>$holiday['start']['date'], 
                            'end'=>$holiday['end']['date'], 
                            'country_id'=>$countryId
                        ],
                );    
            }
        }
    }

    public function getAllHolidays($countryId){
        $country = Country::where('id',$countryId)->get()->first();
        $holidays = Http::get('https://www.googleapis.com/calendar/v3/calendars/en'.$country['country_id'].'%23holiday%40group.v.calendar.google.com/events?key=AIzaSyBpSZoCr4xUGsNzmAuxVw_WT0Q4hVW9Bos')->json();
        return $holidays;
    }

    public function getHolidaysPerCountry($countryId){
        $holidays = Holiday::where('country_id',$countryId)->get();
        return $holidays->map->format();
    }

    public function insertHoliday($holiday){
        $holiday = Holiday::create([
            'holiday_id'=>$holiday->id,
            'summary'=>$holiday->name,
            'start'=>$holiday->start,
            'end'=>$holiday->end,
            'country_id'=>$holiday->country_id,
        ]);

        return response($holiday,200);
    }

    public function deleteHoliday($id){
        $holiday = Holiday::where('id',$id)->get()->first();
        $holiday->delete();
        return response([
            'message'=>'holiday has been deleted successfully'
        ], 200);
    }

    public function updateHoliday($newHoliday){
        $holiday = Holiday::where('id',$newHoliday->id)->get()->first();
        $holiday->update([
            'holiday_id'=>$newHoliday->id,
            'summary'=>$newHoliday->name,
            'start'=>$newHoliday->start,
            'end'=>$newHoliday->end,
            'country_id'=>$newHoliday->country_id,
        ]);

        return response($holiday,200);
    }
}