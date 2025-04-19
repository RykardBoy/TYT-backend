<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // Modify a user
    public function updateUser(string $id_user, array $data): Users
    {
        
        $user = Users::findOrFail($id_user);
        $user->update($data);
    
        return $user;
    }
    
    // Create a user
    public function createUser(array $data){

        return Users::create($data);


    }
}


?>
