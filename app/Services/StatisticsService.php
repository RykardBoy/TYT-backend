<?php

namespace App\Services;

use App\Models\Statistics;

class StatisticsService{
    // Show all statistics
    public function showAllStatistics(){
        $statistics = Statistics::all();
        return response()->json($statistics); // Voir pour changer plus tard. Le service n'est pas censé faire le json
    }

    // Show a specific statistic
    public function showOneStatistics(string $id){
        $statistics = Statistics::findOrFail($id);
        return response()->json($statistics); // Voir pour changer plus tard. Le service n'est pas censé faire le json
    }

    /* J'ai fait cette fonction dans le cas ou il y a un bug. L'admin pourra ajouter manuellement les stats. */
    public function addStatistic(array $data){
        return Statistics::create($data);
    }
    
    public function deleteStatistic(string $id_stat){
        
        $stat = Statistics::findOrFail($id_stat);

        return $stat->delete();
    }

    public function updateStatistic(string $id, array $data){
        $stat = Statistics::findOrFail($id);
        $stat->update($data);
        return $stat;
    }
}


?>
