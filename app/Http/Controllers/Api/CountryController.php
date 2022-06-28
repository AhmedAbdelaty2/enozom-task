<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index(){
        $countries = Http::get('https://restcountries.com/v3.1/all');

        $holidays = Http::get('https://www.googleapis.com/calendar/v3/calendars/en.mk%23holiday%40group.v.calendar.google.com/events?key=AIzaSyBpSZoCr4xUGsNzmAuxVw_WT0Q4hVW9Bos');

        return $countries->json();
    }
}
