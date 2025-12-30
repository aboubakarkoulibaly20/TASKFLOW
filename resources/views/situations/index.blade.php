@extends('layout')
@section('title','Situations')
@section('content')
<div class="container-fluid container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Situations (fiscales & sociales)</h3>
        <a href="{{ route('situations.create') }}" class="btn btn-primary">Ajouter</a>
    </div>

    <form method="get" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Type impôt</label>
                <input type="text" name="type_impot" class="form-control" value="{{ request('type_impot') }}" placeholder="Ex: TVA">
            </div>
            <div class="col-md-3">
                <label class="form-label">Type sociale</label>
                <input type="text" name="type_sociale" class="form-control" value="{{ request('type_sociale') }}" placeholder="Ex: CNSS">
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <input type="text" name="status" class="form-control" value="{{ request('status') }}" placeholder="Ex: payé / en retard">
            </div>
            <div class="col-md-3">
                <label class="form-label">Période</label>
                <input type="text" name="periode" class="form-control" value="{{ request('periode') }}" placeholder="Ex: 2025-01 ou 2025-Q1">
            </div>
            <div class="col-md-3">
                <label class="form-label">Client ID</label>
                <input type="number" name="client_id" class="form-control" value="{{ request('client_id') }}" placeholder="ID client">
            </div>
            <div class="col-12 d-flex gap-2 mt-2">
                <button class="btn btn-outline-primary">Filtrer</button>
                <a href="{{ route('situations.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Type Impôt</th>
                        <th>Type Sociale</th>
                        <th>Régime</th>
                        <th>Montant</th>
                        <th>Période</th>
                        <th>Date Paiement</th>
                        <th>Statut</th>
                        <th>Fichier</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($situations as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>
                                @if($s->client)
                                    {{ $s->client->first_name }} {{ $s->client->last_name }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $s->type_impot }}</td>
                            <td>{{ $s->type_sociale }}</td>
                            <td>{{ $s->regime }}</td>
                            <td>{{ $s->montant }}</td>
                            <td>{{ $s->periode }}</td>
                            <td>{{ $s->date_paiement }}</td>
                            <td>{{ $s->status }}</td>
                            <td>
                                @if($s->file)
                                    <a href="{{ asset('storage/'.$s->file) }}" target="_blank">Voir</a>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('situations.edit', $s->id) }}" class="btn btn-sm btn-outline-primary">Éditer</a>
                                <form action="{{ route('situations.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Supprimer cette situation ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">Aucune situation trouvée.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(method_exists($situations, 'links'))
            <div class="card-footer">{{ $situations->links() }}</div>
        @endif
    </div>
</div>
@endsection
