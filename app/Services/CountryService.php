<?php

namespace App\Services;

use App\Models\Countries;

class CountryService{
    // Show all countries
    public function showAllCountries(){
        $countries = Countries::all();
        return response()->json($countries);
    }

    // Show a specific country
    public function showOneCountry(string $id){
        $country = Countries::findOrFail($id);
        return response()->json($country);
    }
}


?>
