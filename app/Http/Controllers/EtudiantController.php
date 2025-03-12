<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Afficher la liste des stages disponibles
     */
    public function index() {
        $stages = Stage::all();
        return view('etudiant.stages', compact('stages'));
    }

    /**
     * Permettre à un étudiant de postuler à un stage
     */
    public function postuler($id) {
        // Vérifier si l’étudiant a déjà postulé à ce stage
        $existe = Candidature::where('etudiant_id', Auth::id())
                             ->where('stage_id', $id)
                             ->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à ce stage.');
        }

        // Créer une nouvelle candidature
        Candidature::create([
            'etudiant_id' => Auth::id(),
            'stage_id' => $id,
            'status' => 'En attente'
        ]);

        return redirect()->back()->with('success', 'Votre candidature a été envoyée.');
    }

    /**
     * Afficher les candidatures de l'étudiant
     */
    public function mesCandidatures() {
        $candidatures = Candidature::where('etudiant_id', Auth::id())->get();

        if ($candidatures->isEmpty()) {
            return redirect()->back()->with('info', 'Vous n\'avez pas encore postulé à un stage.');
        }

        return view('etudiant.candidatures', compact('candidatures'));
    }
}

