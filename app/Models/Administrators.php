<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrators extends Model
{
    protected $table = 'administrators'; 
    protected $primaryKey = 'id_user_admin';
    public $timestamps = false;

    protected $fillable = [
        'id_user'
    ];
}
