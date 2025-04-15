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
        return $admin;
    }

    public function show($id){
        $admin = $this->administrator->showOneAdmin($id);
        return $admin;
    }
}
