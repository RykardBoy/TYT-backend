<?php

namespace App\Services;

use App\Models\Statistics;

class StatisticsService{
    // Show all statistics
    public function showAllStatistics(){
        $statistics = Statistics::all();
        return response()->json($statistics);
    }

    // Show a specific statistic
    public function showOneStatistics(string $id){
        $statistics = Statistics::findOrFail($id);
        return response()->json($statistics);
    }
}


?>
