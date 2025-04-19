<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Services\CountryService;
use Illuminate\Support\Facades\Log;


class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService){
        $this->countryService = $countryService;
    }


    public function index(){
        $countries = $this->countryService->showAllCountries();
        return $countries;
    }

    public function show($id){
        $country = $this->countryService->showOneCountry($id);
        return $country;
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
            'km' => 'required|int',
            'estimated_budget' => 'required|int',
        ]);

        try {
            $country = $this->countryService->createCountry($validated);
            return response()->json([
                'message' => 'Country successfuly created',
                'country' => $country
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error when creating country : ', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }    
    }

    public function update(Request $request, string $id_country){
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'continent' => 'sometimes|string|max:255',
            'km' => 'sometimes|int',
            'estimated_budget' => 'sometimes|int',
        ]);

        $updatedCountry = $this->countryService->updateCountry($id_country, $validated);

        return response()->json([
            'message' => 'Country successfuly updated',
            'country' => $updatedCountry
        ]);
    }

    public function destroy(string $id_country){
        
        $deletedCountry = $this->countryService->deleteCountry($id_country);
        
        return response()->json([
            'message' => 'country successfuly removed',
            'country' => $deletedCountry
        ]);

    }
}
