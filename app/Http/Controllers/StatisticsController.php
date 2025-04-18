<?php

namespace App\Http\Controllers;


use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    protected $statistics;

    public function __construct(StatisticsService $statistics){
        $this->statistics = $statistics;
    }

    public function index(){
        $statistics = $this->statistics->showAllStatistics();
        return $statistics;
    }
}
