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


    // Create a country
    public function createCountry(array $data){
        return Countries::create($data);
    }

    // Update a country
    public function updateCountry(string $id_country, array $data){
        $country = Countries::findOrFail($id_country);
        $country->update($data);
        return $country;
    }
}


?>
