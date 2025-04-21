<?php

namespace App\Services;

use App\Models\Administrators;

class AdministratorService{
    // Show all admins
    public function showAllAdmin(){
        $admin = Administrators::all();
        return $admin;
    }

    // Show a specific admin
    public function showOneAdmin(string $id){
        $admin = Administrators::findOrFail($id);
        return $admin;
    }


    public function addAdministrator(array $data){
        return Administrators::create($data);
    }

    /* This function target the id_admin_user (PK) and not the id_user */

    public function deleteAdministrator(string $id){
        $admin = Administrators::findorfail($id);
        return $admin->delete();
    }

    
}


?>
