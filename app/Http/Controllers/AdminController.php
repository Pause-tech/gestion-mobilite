<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobilite;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Afficher le tableau de bord de l'admin.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Afficher la liste des demandes de mobilité.
     */
    public function mobilites()
    {
        $mobilites = Mobilite::with('etudiant')->get();
        return view('admin.mobilites', compact('mobilites'));
    }

    /**
     * Valider une demande de mobilité.
     */
    public function valider($id)
    {
        $mobilite = Mobilite::findOrFail($id);
        $mobilite->status = 'validé';
        $mobilite->save();

        return back()->with('success', 'Mobilité validée avec succès.');
    }

    /**
     * Refuser une demande de mobilité avec motif.
     */
    public function refuser(Request $request, $id)
    {
        $mobilite = Mobilite::findOrFail($id);
        $mobilite->status = 'refusé';
        $mobilite->motif_refus = $request->motif_refus;
        $mobilite->save();

        return back()->with('success', 'Mobilité refusée avec une raison.');
    }
}
