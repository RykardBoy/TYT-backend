<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Services\CountryService;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService){
        $this->countryService = $countryService;
    }


    public function index(){
        $countries = $this->countryService->showAllCountries();
        return $countries;
    }

    public function show($id){
        $country = $this->countryService->showOneCountry($id);
        return $country;
    }

}
