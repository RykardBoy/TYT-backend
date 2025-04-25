<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Countries;


class Users extends Model
{
    use HasApiTokens, HasRoles;

    protected $table = 'users'; 

    protected $primaryKey = 'id_user';



    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
        'country'
    ];

    public function countries(){
        
        return $this->belongsToMany(Countries::class, 'visited_country', 'id_user', 'id_country');
    }
    
}
