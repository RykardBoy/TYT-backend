<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class TestController extends Controller
{
    public function test(){
        $user = Auth::user();

                
    }
}
