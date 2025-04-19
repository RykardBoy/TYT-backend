<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisitedCountryService;

class VisitedCountryController extends Controller
{
    protected $visitedCountry;

    public function __construct(VisitedCountryService $visitedCountry){
        $this->visitedCountry = $visitedCountry;
    }

    public function index(){
        $visitedCountries = $this->visitedCountry->showAllVisitedCountries();
        return $visitedCountries;
    }

    public function show($id){
        $visitedCountry = $this->visitedCountry->showOneVisitedCountry($id);
        return $visitedCountry;
    }

    // REVOIR ICI ( FAIRE AUTH )
    public function store(Request $request, array $data){
        $validated = $request->validate([
            'id_user' => 'require',
            'id_country' => 'require',
            'description' => 'sometimes|string|max:255',
            'photos' => 'sometimes',
            'nb_stars' => 'require',
        ]);

        $souvenir = $this->visitedCountry->addSouvenir($data);

        return response()->json([
            'message' => 'Souvenirs added successfuly',
            'souvenirs' => $souvenir
        ]);
    }
}
