<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Holiday;
use Illuminate\Support\Facades\Http;

class HolidayService
{
    public static function syncHolidays($country){
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

    public static function getAllHolidays($country){
        $holidays = Http::get('https://www.googleapis.com/calendar/v3/calendars/en'.$country['country_id'].'%23holiday%40group.v.calendar.google.com/events?key=AIzaSyBpSZoCr4xUGsNzmAuxVw_WT0Q4hVW9Bos')->json();
        return $holidays;
    }

    public static function getHolidaysPerCountry($countryId){
        $country = Country::where('country_id','.'.$countryId)->get()->first();
        $holidays = Holiday::where('country_id',$country->id)->get();
        return $holidays->map->format();
    }

    public static function insertHoliday($request){
        $country = Country::where('country_id','.'.$request->country_id)->get()->first();

        $holiday = Holiday::create([
            'id'=>$request->id,
            'summary'=>$request->name,
            'start'=>$request->start,
            'end'=>$request->end,
            'country_id'=>$country->id,
        ]);

        return response($holiday,200);
    }

    public static function deleteHoliday($id){
        $holiday = Holiday::where('id',$id)->get()->first();
        $holiday->delete();
        return response([
            'message'=>'holiday has been deleted successfully'
        ], 200);
    }

    public static function updateHoliday($request){
        $country = Country::where('country_id','.'.$request->country_id)->get()->first();
        $holiday = Holiday::where('id',$request->id)->get()->first();
        $holiday->update([
            'id'=>$request->id,
            'summary'=>$request->name,
            'start'=>$request->start,
            'end'=>$request->end,
            'country_id'=>$country->id,
        ]);

        return response($holiday,200);
    }
}