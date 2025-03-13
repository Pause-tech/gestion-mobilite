<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mobilite extends Model
{
    use HasFactory; // Ajout de HasFactory

    protected $fillable = [
        'user_id',
        'pays_destination',
        'universite_accueil',
        'ville',
        'date_debut',
        'date_fin',
        'motivation',
        'status', // Suppression du doublon 'status'
        'motif_refus'
    ];

    /**
     * Relation avec l'utilisateur (celui qui fait la demande de mobilité).
     * Une mobilité appartient à un utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

