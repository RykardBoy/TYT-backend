<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Users;

/* This class is used to manage the permission and roles */


class AdminController extends Controller
{
    public function createRolesAndPermissions()
    {
        // Crée le rôle admin s’il n’existe pas déjà
        $roleAdmin = Role::create(['name' => 'admin']);
        // Crée les permissions s’elles n’existent pas
        $permAddUser = Permission::create(['name' => 'add user']);
        $permDeleteUser = Permission::create(['name' => 'delete user']);


        // Associe les permissions au rôle admin
        $roleAdmin->syncPermissions([$permAddUser, $permDeleteUser]);

        return response()->json([
            'message' => 'Rôle et permissions créés et liés avec succès.'
        ]);
    }

    public function assignRole(Request $request, string $id_user){
        $userAdmin = Users::findorfail($id_user); 
        $userAdmin->syncRoles($request->input('roles'));// "message": "The given role or permission should use guard `` instead of `web`.", <---- FIX THIS
    }

}
