<?php

namespace App\Http\Controllers;

use App\Models\Statistics;

class StatisticsController extends Controller
{
    protected $statistics;

    public function __construct(Statistics $statistics){
        $this->statistics = $statistics;
    }
}
