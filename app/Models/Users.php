<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    // Si ton nom de table est différent, ajoute la ligne suivante
    protected $table = 'users';  // Assure-toi que c'est bien 'users'

    // Si tu n'as pas de clé primaire standard (id), définis la clé primaire
    protected $primaryKey = 'id_user';  // Assure-toi que la clé primaire est bien 'id'

    // Si tu n'as pas de champs 'created_at' et 'updated_at', désactive-les
    public $timestamps = false; // Si tu ne les utilises pas
}
