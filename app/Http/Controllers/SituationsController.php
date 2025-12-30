<?php

namespace App\Http\Controllers;

use App\Models\Situation;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SituationsController extends Controller
{
    public function index(Request $request)
    {
        $query = Situation::with('client')->latest();

        $query->when($request->filled('type_impot'), function ($q) use ($request) {
            $q->where('type_impot', 'like', '%' . $request->get('type_impot') . '%');
        });
        $query->when($request->filled('type_sociale'), function ($q) use ($request) {
            $q->where('type_sociale', 'like', '%' . $request->get('type_sociale') . '%');
        });
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', 'like', '%' . $request->get('status') . '%');
        });
        $query->when($request->filled('periode'), function ($q) use ($request) {
            $q->where('periode', 'like', '%' . $request->get('periode') . '%');
        });
        $query->when($request->filled('client_id'), function ($q) use ($request) {
            $q->where('client_id', $request->get('client_id'));
        });

        $situations = $query->paginate(20)->appends($request->query());
        return view('situations.index', compact('situations'));
    }

    public function create()
    {
        $clients = Client::select('id','company','first_name','last_name')->get();
        return view('situations.create', compact('clients'));
    }

    /**
     * Liste des situations fiscales (type_impot non nul)
     */
    public function fiscal(Request $request)
    {
        $query = Situation::with('client')->whereNotNull('type_impot')->latest();
        // Appliquer les mêmes filtres que index
        $query->when($request->filled('type_impot'), fn($q) => $q->where('type_impot','like','%'.$request->type_impot.'%'));
        $query->when($request->filled('status'), fn($q) => $q->where('status','like','%'.$request->status.'%'));
        $query->when($request->filled('periode'), fn($q) => $q->where('periode','like','%'.$request->periode.'%'));
        $query->when($request->filled('client_id'), fn($q) => $q->where('client_id',$request->client_id));
        $situations = $query->paginate(20)->appends($request->query());
        return view('situations.index', compact('situations'));
    }

    /**
     * Liste des situations sociales (type_sociale non nul)
     */
    public function social(Request $request)
    {
        $query = Situation::with('client')->whereNotNull('type_sociale')->latest();
        // Appliquer les mêmes filtres que index
        $query->when($request->filled('type_sociale'), fn($q) => $q->where('type_sociale','like','%'.$request->type_sociale.'%'));
        $query->when($request->filled('status'), fn($q) => $q->where('status','like','%'.$request->status.'%'));
        $query->when($request->filled('periode'), fn($q) => $q->where('periode','like','%'.$request->periode.'%'));
        $query->when($request->filled('client_id'), fn($q) => $q->where('client_id',$request->client_id));
        $situations = $query->paginate(20)->appends($request->query());
        return view('situations.index', compact('situations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_impot' => 'nullable|string|max:255',
            'type_sociale' => 'nullable|string|max:255',
            'regime' => 'nullable|string|max:255',
            'montant' => 'nullable|numeric',
            'periode' => 'nullable|string|max:255',
            'date_paiement' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'file' => 'nullable|file|max:8192',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('situations', 'public');
        }
        $data['created_by'] = auth()->id();

        Situation::create($data);
        return redirect()->back()->with('success', 'Situation enregistrée avec succès.');
    }

    public function edit($id)
    {
        $situation = Situation::findOrFail($id);
        $clients = Client::select('id','company','first_name','last_name')->get();
        return view('situations.edit', compact('situation','clients'));
    }

    public function update(Request $request)
    {
        $id = $request->validate(['id' => 'required|exists:situations,id'])['id'];
        $situation = Situation::findOrFail($id);

        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_impot' => 'nullable|string|max:255',
            'type_sociale' => 'nullable|string|max:255',
            'regime' => 'nullable|string|max:255',
            'montant' => 'nullable|numeric',
            'periode' => 'nullable|string|max:255',
            'date_paiement' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'file' => 'nullable|file|max:8192',
        ]);

        if ($request->hasFile('file')) {
            // delete old if exists
            if ($situation->file) {
                Storage::disk('public')->delete($situation->file);
            }
            $data['file'] = $request->file('file')->store('situations', 'public');
        }

        $situation->update($data);
        return redirect()->back()->with('success', 'Situation mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $situation = Situation::findOrFail($id);
        if ($situation->file) {
            Storage::disk('public')->delete($situation->file);
        }
        $situation->delete();
        return redirect()->back()->with('success', 'Situation supprimée avec succès.');
    }
}
