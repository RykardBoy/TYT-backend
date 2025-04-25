<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Users;


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

    public function users(){
        return $this->BelongsToMany(Users::class, 'visited_country', 'id_user', 'id_country');
    }
}