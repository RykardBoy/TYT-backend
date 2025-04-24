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
        $roleAdmin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        // Crée les permissions s’elles n’existent pas
        $permAddUser = Permission::create(['name' => 'add user', 'guard_name' => 'api']);
        $permDeleteUser = Permission::create(['name' => 'delete user', 'guard_name' => 'api']);

        $roleAdmin->givePermissionTo([$permAddUser, $permDeleteUser]);


        // Associe les permissions au rôle admin
        $roleAdmin->syncPermissions([$permAddUser, $permDeleteUser]);

        return response()->json([
            'message' => 'Rôle et permissions créés et liés avec succès.'
        ]);
    }

    public function assignRole(Request $request, string $id_user){
        $userAdmin = Users::findOrFail($id_user);

        // Forcer le guard à 'api'
        $roleName = $request->input('roles');

        $userAdmin->assignRole(Role::findByName($roleName, 'api'));

        return response()->json([
            'message' => "Rôle '$roleName' assigné avec succès à l'utilisateur.",
    ]);
    }

}
