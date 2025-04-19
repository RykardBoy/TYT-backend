<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
   
    protected $table = 'countries'; 

    protected $primaryKey = 'id_country';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'continent',
        'km',
        'estimated_budget',
    ];

}