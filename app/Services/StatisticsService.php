<?php

namespace App\Services;

use App\Models\Statistics;

class CountryService{
    // Show all countries
    public function showAllStatistics(){
        $statistics = Statistics::all();
        return response()->json($statistics);
    }

    // Show a specific country
    public function showOneStatistics(string $id){
        $statistics = Statistics::findOrFail($id);
        return response()->json($statistics);
    }
}


?>
