<?php

namespace App\Services;

use App\Models\Holiday;
use Illuminate\Support\Facades\Http;

class HolidayService
{
    public static function getAllHolidays($country){
        $holidays = Http::get('https://www.googleapis.com/calendar/v3/calendars/en'.$country['country_id'].'%23holiday%40group.v.calendar.google.com/events?key=AIzaSyBpSZoCr4xUGsNzmAuxVw_WT0Q4hVW9Bos')->json();
        return $holidays;
    }

    public static function insertOrUpdateHolidays($country){
        $holidays = HolidayService::getAllHolidays($country);
        if(isset($holidays['items'])){
            $holidays = $holidays['items'];
            foreach($holidays as $holiday){
                $updatedHoliday = Holiday::updateOrCreate(
                        [
                            'id'=>$holiday['id']
                        ],
                        [
                            'summary'=>$holiday['summary'], 
                            'start'=>$holiday['start']['date'], 
                            'end'=>$holiday['end']['date'], 
                            'country_id'=>$country['id']
                        ],
                    );    
            }
        }
    }
}