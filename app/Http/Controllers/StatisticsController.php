<?php

namespace App\Http\Controllers;


use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Statistics;
use Illuminate\Support\Facades\DB;


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

    public function showStatistics(Request $request){
    $countryName = $request->query('country');

    $statisticsQuery = Statistics::with('country');

    if ($countryName) {
        $statisticsQuery->whereHas('country', function ($query) use ($countryName) {
            $query->where('name', $countryName);
        });
    }

    $statistics = $statisticsQuery->get()->map(function ($stat) {
        return [
            'id_statistics' => $stat->id_statistics,
            'id_country' => $stat->id_country,
            'name' => $stat->country->name ?? null,
            'number_users' => $stat->number_users,
            'total_days' => $stat->total_days,
            ];
        });

        return response()->json($statistics);
    }
    public function sumDays(){
        $totalDays = \App\Models\Statistics::sum('total_days'); // Somme de la colonne "days" dans la table "statistics"
        
        return response()->json([
            'total_days' => $totalDays
        ]);
    }


    public function frequentCountry(){
        $mostFrequent = DB::table('statistics')
            ->join('countries', 'statistics.id_country', '=', 'countries.id_country')
            ->select('countries.name', DB::raw('count(*) as total'))
            ->groupBy('countries.name')
            ->orderByDesc('total')
            ->limit(1)
            ->first();
    
        return response()->json([
            'country' => $mostFrequent->name,
            'count' => $mostFrequent->total
        ]);
    }

    public function mostFrequentUserCountry(){
        $mostFrequent = DB::table('users')
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(1)
            ->first();

        return response()->json([
            'country' => $mostFrequent->country,
            'count' => $mostFrequent->total
        ]);
    }

    public function favoriteCountryByUser($id_user)
    {
        $mostVisitedCountry = DB::table('visited_country')
            ->join('countries', 'visited_country.id_country', '=', 'countries.id_country')
            ->select('countries.name', DB::raw('count(*) as visit_count'))
            ->where('visited_country.id_user', $id_user)
            ->groupBy('countries.name')
            ->orderByDesc('visit_count')
            ->limit(1)
            ->first();

        if (!$mostVisitedCountry) {
            return response()->json([
                'message' => 'No visits found for this user'
            ], 404);
        }

        return response()->json([
            'id_user' => $id_user,
            'favorite_country' => $mostVisitedCountry->name,
            'visits' => $mostVisitedCountry->visit_count
        ]);
    }

    public function countriesKmTravelled($id_user)
    {
        $kmTravelled = DB::table('visited_country')
                            ->join('countries', 'visited_country.id_country', '=', 'countries.id_country')
                            ->where('visited_country.id_user', $id_user)
                            ->sum('countries.km');


        return response()->json([
            'id_user' => $id_user,
            'total_km' => $kmTravelled
        ]);

    }

    public function countUserPhotos($id_user){
        $photoCount = DB::table('visited_country')
            ->where('id_user', $id_user)
            ->whereNotNull('image') // S'assure que l'entrée a une image
            ->count();

        return response()->json([
            'id_user' => $id_user,
            'total_photos' => $photoCount
        ]);
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
