<?php

namespace App\Http\Controllers;


use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    protected $statistics;

    public function __construct(StatisticsService $statistics){
        $this->statistics = $statistics;
    }

    public function index(){
        $statistics = $this->statistics->showAllStatistics();
        return $statistics;
    }

    public function store(Request $request){

        $validated = $request->validate([
            'id_country' => 'required|int',
            'number_users' => 'required|int',
            'total_days' => 'required|int'
        ]);

        try {
            $stat = $this->statistics->addStatistic($validated);
            return response()->json([
                'message' => 'Stat successfully created',
                'country' => $stat
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error when creating the stat : ', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }
    }

    public function destroy(string $id){
        
        try {
            $this->statistics->deleteStatistic($id);
            return response()->json([
                'message' => 'Stat deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error when deleting the stat : ', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }
    }

    public function update(Request $request, string $id){
        $validated = $request->validate([
            'id_country' => 'sometimes|int',
            'number_users' => 'sometimes|int',
            'total_days' => 'sometimes|int'
        ]);

        try {
            $stat = $this->statistics->updateStatistic($id, $validated);

            return response()->json([
                'message' => 'Stat updated successfully',
                'country' => $stat
            ]);
        } catch (\Exception $e) {
            Log::error('Error when updating the stat : ', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }
    }

    
}
