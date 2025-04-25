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
            'message' => 'Souvenirs added successfully',
            'souvenirs' => $souvenir
        ]);
    }

    public function addSouvenir (Request $request){
        // Récupération de l'utilisateur connecté
        $user = Auth::user();

        // Debug facultatif
        Log::info('Utilisateur connecté : ', ['user' => $user]);

        // Sécurité : vérification que l'utilisateur est bien authentifié
        if (!$user) {
            return response()->json(['message' => 'Non autorisé'], 401);
        }

        // Validation des champs reçus (id_user est déduit, donc non attendu dans la requête)
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_country' => 'required|integer|exists:countries,id_country', // vérifie si le pays existe
            'description' => 'required|string|max:1000',
            'nb_stars' => 'required|integer|min:1|max:5',
        ]);

        // Création du dossier si besoin
        $uploadPath = public_path('uploads');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Traitement de l'image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($uploadPath, $imageName);

        // Enregistrement dans la base
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
