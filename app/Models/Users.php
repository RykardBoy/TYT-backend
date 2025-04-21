<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Users extends Model
{
    use HasApiTokens;

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
    
}
