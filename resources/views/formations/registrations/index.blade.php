@extends('layout')
@section('title','Formations - Inscriptions')
@section('content')
<div class="container-fluid container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Formations - Inscriptions</h3>
        <a href="{{ route('formations.registrations.create') }}" class="btn btn-primary">Ajouter</a>
    </div>

    <form method="get" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Nom complet</label>
                <input type="text" name="nom_complet" class="form-control" value="{{ request('nom_complet') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ request('email') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="{{ request('telephone') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <input type="text" name="statut" class="form-control" value="{{ request('statut') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Transaction #</label>
                <input type="text" name="transaction_id" class="form-control" value="{{ request('transaction_id') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Date d'inscription</label>
                <input type="date" name="date_inscription" class="form-control" value="{{ request('date_inscription') }}">
            </div>
            <div class="col-12 d-flex gap-2 mt-2">
                <button class="btn btn-outline-primary">Filtrer</button>
                <a href="{{ route('formations.registrations.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Tickets</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date inscription</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($registrations as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->nom_complet }}</td>
                            <td>{{ $r->email }}</td>
                            <td>{{ $r->telephone }}</td>
                            <td>{{ $r->nombre_tickets }}</td>
                            <td>{{ $r->montant }}</td>
                            <td>{{ $r->statut }}</td>
                            <td>{{ $r->date_inscription }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('formations.registrations.edit', $r->id) }}" class="btn btn-sm btn-outline-primary">Éditer</a>
                                <form action="{{ route('formations.registrations.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Supprimer cette inscription ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">Aucune inscription trouvée.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(method_exists($registrations, 'links'))
            <div class="card-footer">{{ $registrations->links() }}</div>
        @endif
    </div>
</div>
@endsection
