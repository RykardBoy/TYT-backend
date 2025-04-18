<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Http\Request;

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
    public function updateUser(Users $user, array $data): Users
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return $user;
    }
    // Create a user
}


?>
