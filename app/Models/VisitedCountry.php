<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitedCountry extends Model
{
    protected $table = 'visited_country'; 

    protected $primaryKey = 'id_user_country'; 

    
    public $timestamps = false;

    protected $fillable = [
        'id_user', // sera remplie avec l'id de la personne qui l'ajoute
        'id_country', // sera remplie avec la sélection de la liste déroulante
        'description',
        'photos',
        'nb_stars',
    ];
}
