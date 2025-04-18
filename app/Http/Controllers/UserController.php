<?php

namespace App\Http\Controllers;


use App\Services\UserService;

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
}
