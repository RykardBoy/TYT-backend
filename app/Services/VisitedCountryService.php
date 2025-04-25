<?php

namespace App\Services;

use App\Models\VisitedCountry;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Models\Users;


class VisitedCountryService{

    
    // Show all visited countries
    public function showAllVisitedCountries(){

        return Users::with('countries')->get();
    }
    
    // Show a specific visited country
    public function showOneVisitedCountry($id_user){

        $user = Users::find($id_user);
        
        if (!$user) {
            return [];
        }

        
        return $user->countries;
    }
}
?>
