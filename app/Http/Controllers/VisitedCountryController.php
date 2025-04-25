<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisitedCountryService;
use App\Models\VisitedCountry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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


    public function addSouvenir (Request $request){
        // No check if user authentified because middleware already check it
        $user = Auth::user();

        Log::info('Utilisateur connecté : ', ['user' => $user]); // for debugging

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_country' => 'required|integer|exists:countries,id_country',
            'description' => 'required|string|max:1000',
            'nb_stars' => 'required|integer|min:1|max:5',
        ]);

        $uploadPath = public_path('uploads');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // saving image in folder
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($uploadPath, $imageName);
        // INSERT
        $souvenir = VisitedCountry::create([
            'id_user' => $user->id_user,
            'id_country' => $validated['id_country'],
            'description' => $validated['description'],
            'nb_stars' => $validated['nb_stars'],
            'image' => 'uploads/' . $imageName,
        ]);

        return response()->json([
            'message' => 'Souvenir enregistré avec succès',
            'data' => $souvenir
        ], 201);
    }
}
