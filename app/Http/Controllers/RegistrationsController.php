<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationsController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::query()->latest();

        $query->when($request->filled('nom_complet'), fn($q) => $q->where('nom_complet', 'like', '%' . $request->nom_complet . '%'));
        $query->when($request->filled('email'), fn($q) => $q->where('email', 'like', '%' . $request->email . '%'));
        $query->when($request->filled('telephone'), fn($q) => $q->where('telephone', 'like', '%' . $request->telephone . '%'));
        $query->when($request->filled('statut'), fn($q) => $q->where('statut', 'like', '%' . $request->statut . '%'));
        $query->when($request->filled('transaction_id'), fn($q) => $q->where('transaction_id', 'like', '%' . $request->transaction_id . '%'));
        $query->when($request->filled('date_inscription'), fn($q) => $q->whereDate('date_inscription', $request->date_inscription));

        $registrations = $query->paginate(20)->appends($request->query());
        return view('formations.registrations.index', compact('registrations'));
    }

    public function create()
    {
        return view('formations.registrations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'transaction_id' => 'nullable|string|max:255',
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:50',
            'nombre_tickets' => 'nullable|integer|min:1',
            'montant' => 'nullable|numeric',
            'devise' => 'nullable|string|max:10',
            'statut' => 'nullable|string|max:50',
            'date_inscription' => 'nullable|date',
            'reference_paiement' => 'nullable|string|max:255',
            'methode_paiement' => 'nullable|string|max:100',
            'date_paiement' => 'nullable|date',
            'commentaire_admin' => 'nullable|string',
            'ticket_number' => 'nullable|string|max:255',
        ]);

        Registration::create($data);
        return redirect()->route('formations.registrations.index')->with('success', 'Inscription ajoutée avec succès.');
    }

    public function edit($id)
    {
        $registration = Registration::findOrFail($id);
        return view('formations.registrations.edit', compact('registration'));
    }

    public function update(Request $request)
    {
        $id = $request->validate(['id' => 'required|exists:registrations,id'])['id'];
        $registration = Registration::findOrFail($id);

        $data = $request->validate([
            'transaction_id' => 'nullable|string|max:255',
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:50',
            'nombre_tickets' => 'nullable|integer|min:1',
            'montant' => 'nullable|numeric',
            'devise' => 'nullable|string|max:10',
            'statut' => 'nullable|string|max:50',
            'date_inscription' => 'nullable|date',
            'reference_paiement' => 'nullable|string|max:255',
            'methode_paiement' => 'nullable|string|max:100',
            'date_paiement' => 'nullable|date',
            'commentaire_admin' => 'nullable|string',
            'ticket_number' => 'nullable|string|max:255',
        ]);

        $registration->update($data);
        return redirect()->route('formations.registrations.index')->with('success', 'Inscription mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return redirect()->route('formations.registrations.index')->with('success', 'Inscription supprimée avec succès.');
    }
}
