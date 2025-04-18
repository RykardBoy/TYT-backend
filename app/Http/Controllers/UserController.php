<?php

namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Users;

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

    public function update(Request $request, Users $users)
    {
        $validated = $request->validate([
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $users->id,
            'country' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
        ]);

        $updatedUser = $this->userService->updateUser($users, $validated);

        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user' => $updatedUser
        ]);
    }
}
