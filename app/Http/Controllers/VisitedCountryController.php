<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisitedCountryService;

class VisitedCountryController extends Controller
{
    protected $visitedCountry;

    public function __construct(VisitedCountryService $visitedCountry){
        $this->visitedCountry = $visitedCountry;
    }

    public function index(){
        $visitedCountries = $this->visitedCountry->showAllVisitedCountries();
        return $visitedCountries;
    }

    public function show($id){
        $visitedCountry = $this->visitedCountry->showOneVisitedCountry($id);
        return $visitedCountry;
    }
}
