<?php

namespace App\Services;

use App\Models\VisitedCountry;

class VisitedCountryService{

    // Show all visited countries
    public function showAllVisitedCountries(){
        $countries = VisitedCountry::all();
        return response()->json($countries);
    }

    // Show a specific visited country (COMPLETER POUR VOIR SI ON CHERCHE USER OU PAYS)
    public function showOneVisitedCountry(string $id){
        $country = VisitedCountry::findOrFail($id);
        return response()->json($country);
    }
}
?>
