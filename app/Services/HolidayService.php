<?php

namespace App\Services;

use App\Models\Holiday;
use Illuminate\Support\Facades\Http;

class HolidayService
{
    public static function getAllHolidays($countryId){
        $holidays = Http::get('https://www.googleapis.com/calendar/v3/calendars/en'.$countryId.'%23holiday%40group.v.calendar.google.com/events?key=AIzaSyBpSZoCr4xUGsNzmAuxVw_WT0Q4hVW9Bos')->json();
        // return $holidays['items'][0]['start']['date'];
        return $holidays;
    }

    public static function insertOrUpdateHolidays($countryId){
        $holidays = HolidayService::getAllHolidays($countryId);
        foreach($holidays as $holiday){
            // $updateHoliday = Holiday::updateOrCreate(
            //         ['country_id'=>$countryId],
            //         ['summary'=>$holiday['tld'][0], 'start'=>$holiday['name']['common'], 'end'=>$holiday],
            //     );
        }
    }
}