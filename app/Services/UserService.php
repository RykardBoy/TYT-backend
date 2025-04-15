<?php

namespace App\Services;

use App\Models\Users;

class UserService{

    // Show all users
    public function showAllUsers(){
        $user = Users::all();
        return response()->json($user);
    }

    // Show a specific user
    public function showOneUser(string $id){
        $users = Users::findOrFail($id);
        return response()->json($users);
    }

    public function deleteUser(string $id){
        $delUser = Users::findOrFail($id);
        $delUser->delete();
        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }
}


?>
