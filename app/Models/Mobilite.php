<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobilite extends Model
{
    
    protected $fillable = ['user_id', 'pays_destination', 'universite_accueil','ville','date_debut','date_fin','motivation','status','statut', 'motif_refus'];
    public function etudiant()
{ 
    return $this->belongsTo(Etudiant::class);
}
}
