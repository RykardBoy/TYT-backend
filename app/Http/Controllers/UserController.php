<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function index() {
        $users = Users::all(); // Récupère tous les utilisateurs de la BDD
        return response()->json($users); // Retourne les utilisateurs en JSON
    }
}
