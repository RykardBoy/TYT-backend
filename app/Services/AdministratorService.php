<?php

namespace App\Services;

use App\Models\Administrators;

class AdministratorService{
    // Show all admins
    public function showAllAdmin(){
        $admin = Administrators::all();
        return response()->json($admin);
    }

    // Show a specific admin
    public function showOneAdmin(string $id){
        $admin = Administrators::findOrFail($id);
        return response()->json($admin);
    }

    
}


?>
