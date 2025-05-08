<?php

namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }


    public function index(){
        $countries = $this->userService->showAllUsers();
        return $countries;
    }

    public function show($id){
        $country = $this->userService->showOneUser($id);
        return $country;
    }

    public function destroy($id){
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'Utilisateur supprimé avec succès.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Utilisateur introuvable ou erreur lors de la suppression.'], 404);
        }
    }

    public function update(Request $request, string $id_user){
        $validated = $request->validate([
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id_user . 'id_user',
            'country' => 'sometimes|string|max:255',
            'password' => 'sometimes|nullable|string|min:6'
        ]);

        $updatedUser = $this->userService->updateUser($id_user, $validated);
        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user' => $updatedUser
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'country' => 'nullable|string',
        ]);

        try {
            $user = $this->userService->createUser($validated);
            return response()->json([
                'message' => 'Utilisateur créé avec succès.',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'utilisateur : ', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }
    }

    public function countUsers(){
        $userCount = \App\Models\Users::count(); // Compte tous les utilisateurs dans la table "users"
        
        return response()->json([
            'user_count' => $userCount
        ]);
    }
}
