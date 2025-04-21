<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    protected $table = 'statistics';  

    protected $primaryKey = 'id_statistics'; 

    public $timestamps = false;

    protected $fillable = [
        'id_country',
        'number_users',
        'total_days'
    ];
}
