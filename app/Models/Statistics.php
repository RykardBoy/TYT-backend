<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;

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

    public function country(){
        return $this->belongsTo(Countries::class, 'id_country', 'id_country');
    }
}
