<?php

namespace App\Http\Controllers;

use App\Models\Formulaire;
use Illuminate\Http\Request;

class FormulairesController extends Controller
{
    public function index()
    {
        $formulaires = Formulaire::latest()->paginate(20);
        return view('formations.formulaires.index', compact('formulaires'));
    }

    public function create()
    {
        return view('formations.formulaires.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'transaction_id' => 'nullable|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numero' => 'required|string|max:50',
            'critere' => 'nullable|string|max:255',
            'nom_diplome' => 'nullable|string|max:255',
            'type_operation' => 'nullable|string|max:255',
            'paiement' => 'nullable|string|max:100',
            'date_inscription' => 'nullable|date',
            'statut' => 'nullable|string|max:50',
            'commentaire' => 'nullable|string',
        ]);

        Formulaire::create($data);
        return redirect()->route('formations.formulaires.index')->with('success', 'Formulaire ajouté avec succès.');
    }

    public function edit($id)
    {
        $formulaire = Formulaire::findOrFail($id);
        return view('formations.formulaires.edit', compact('formulaire'));
    }

    public function update(Request $request)
    {
        $id = $request->validate(['id' => 'required|exists:formulaires,id'])['id'];
        $formulaire = Formulaire::findOrFail($id);

        $data = $request->validate([
            'transaction_id' => 'nullable|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numero' => 'required|string|max:50',
            'critere' => 'nullable|string|max:255',
            'nom_diplome' => 'nullable|string|max:255',
            'type_operation' => 'nullable|string|max:255',
            'paiement' => 'nullable|string|max:100',
            'date_inscription' => 'nullable|date',
            'statut' => 'nullable|string|max:50',
            'commentaire' => 'nullable|string',
        ]);

        $formulaire->update($data);
        return redirect()->route('formations.formulaires.index')->with('success', 'Formulaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $formulaire = Formulaire::findOrFail($id);
        $formulaire->delete();
        return redirect()->route('formations.formulaires.index')->with('success', 'Formulaire supprimé avec succès.');
    }
}
