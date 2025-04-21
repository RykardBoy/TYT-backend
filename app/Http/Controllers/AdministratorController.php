<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdministratorService;

class AdministratorController extends Controller
{
    protected $administrator;

    public function __construct(AdministratorService $administrator){
        $this->administrator = $administrator;
    }


    public function index(){
        $admin = $this->administrator->showAllAdmin();
        return response()->json($admin);
    }

    public function show($id){
        $admin = $this->administrator->showOneAdmin($id);
        return response()->json($admin);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user' // looks if the user already exists in the main user table.
        ]);

        if ($validated){
            $this->administrator->addAdministrator($validated);
            return response()->json([
                'message' => 'Administrator added successfully',
                'id' => $validated
            ]);
        } else {
            return response()->json([
                'error' => 'The user doesn\'t exists in the user table'
            ]);
        }
    }

    public function destroy(string $id){
        $deletedAdmin = $this->administrator->deleteAdministrator($id);
        return response()->json([
            'message' => 'Administrator deleted successfully',
            'admin id' => $deletedAdmin
        ]);
    }
}
