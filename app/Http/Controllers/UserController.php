<?php

namespace App\Http\Controllers;


use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }


    public function index(){
        $countries = $this->userService->showAllUsers();
        return $countries;
    }

    public function show($id){
        $country = $this->userService->showOneUser($id);
        return $country;
    }

    public function destroy($id){
        $delUser = $this->userService->deleteUser($id);
        return $delUser;
    }
}
