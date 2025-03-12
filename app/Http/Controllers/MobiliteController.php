<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobilite;
use Illuminate\Support\Facades\Auth;

class MobiliteController extends Controller
{
    public function index()
    {
        $mobilites = Mobilite::where('user_id', Auth::id())->get();
        return view('mobilite.index', compact('mobilites'));
    }

    public function create()
    {
        return view('mobilite.create');
    }
    public function store(Request $request)
    {   
        

        
    
        $request->validate([
            'pays_destination' => 'required|string|max:255',
            'universite_accueil' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'motivation' => 'required|string|max:1000',
            'justificatif' => 'nullable|file|mimes:pdf|max:2048' // Vérifier si un PDF est soumis
        ]);
    
        $justificatifPath = null;
        if ($request->hasFile('justificatif')) {
            $justificatifPath = $request->file('justificatif')->store('justificatifs', 'public');
            \Log::info('📂 Justificatif stocké : ' . $justificatifPath);
        } else {
            \Log::error('❌ Aucun fichier reçu !');
        }
    
        // Insérer les données dans la base de données
        $mobilite = Mobilite::create([
            'user_id' => Auth::id(),
            'pays_destination' => $request->pays_destination,
            'universite_accueil' => $request->universite_accueil,
            'ville' => $request->ville,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motivation' => $request->motivation,
            'justificatif' => $justificatifPath,
            'status' => 'en attente',
        ]);
    
        \Log::info('✅ Mobilité créée avec justificatif', $mobilite->toArray());
    
        return redirect()->route('mobilite.index')->with('success', 'Demande de mobilité envoyée avec succès.');
    }
    

    
    
    
    public function edit(Mobilite $mobilite)
    {
    // Vérifier que l'utilisateur peut modifier sa propre demande
    if ($mobilite->user_id !== Auth::id()) {
        abort(403, 'Accès non autorisé.');
    }

    return view('mobilite.edit', compact('mobilite'));
    }

    public function update(Request $request, Mobilite $mobilite)
    {
        if ($request->hasFile('justificatif')) {
            // Supprimer l'ancien fichier s'il existe
            if ($mobilite->justificatif) {
                \Storage::delete('public/' . $mobilite->justificatif);
            }
            // Enregistrer le nouveau fichier
            $mobilite->justificatif = $request->file('justificatif')->store('justificatifs', 'public');
        }
        
        $mobilite->save();
        

    // Vérifier que l'utilisateur peut modifier sa propre demande
    if ($mobilite->user_id !== Auth::id()) {
        abort(403, 'Accès non autorisé.');
    }

    $request->validate([
        'pays_destination' => 'required|string|max:255',
        'universite_accueil' => 'required|string|max:255',
        'motivation' => 'required|string|max:1000',
    ]);

    $mobilite->update([
        'pays_destination' => $request->pays_destination,
        'universite_accueil' => $request->universite_accueil,
        'motivation' => $request->motivation,
    ]);

    return redirect()->route('mobilite.index')->with('success', 'Demande mise à jour avec succès.');
    }

    public function destroy(Mobilite $mobilite)
    {
    // Vérifier que l'utilisateur peut supprimer sa propre demande
    if ($mobilite->user_id !== Auth::id()) {
        abort(403, 'Accès non autorisé.');
    }

    $mobilite->delete();

    return redirect()->route('mobilite.index')->with('success', 'Demande supprimée avec succès.');
    }
    public function adminIndex(Request $request)
    {
       $statut = $request->query('statut'); // Récupère le filtre de statut
       $mobilites = Mobilite::query();

       if ($statut) {
         $mobilites->where('status', $statut);
    }

       $mobilites = $mobilites->get();

        return view('admin.mobilites.index', compact('mobilites'));
    }

    public function approve($id)
    {
       $mobilite = Mobilite::findOrFail($id);
       $mobilite->status = 'acceptée';
       $mobilite->save();

       return redirect()->route('admin.mobilites.index')->with('success', 'Demande approuvée.');
    }

    public function reject($id)
    {
       $mobilite = Mobilite::findOrFail($id);
       $mobilite->status = 'rejetée';
       $mobilite->save();

       return redirect()->route('admin.mobilites.index')->with('error', 'Demande rejetée.');
}

}
