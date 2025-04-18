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

    // Delete a user
    public function deleteUser(string $id){
        $user = Users::findOrFail($id);

        return $user->delete();
    }
}


?>
