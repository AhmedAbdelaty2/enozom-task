<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

class CountryService
{
    public function syncCountries(){
        $countries = Http::get('https://restcountries.com/v3.1/all')->json();

        foreach ($countries as $country) {
            if(isset($country['tld'])){
                $updatedCountry = Country::updateOrCreate(
                    ['country_id'=>$country['tld'][0]],
                    ['country_id'=>$country['tld'][0], 'country_name'=>$country['name']['common']],
                );
            }
        }
    }

    public function getPagedCountries($perPage, $currentPage){
        $data = Country::paginate($perPage,['*'],'page', $currentPage);
        return response($data,200);
    }
}