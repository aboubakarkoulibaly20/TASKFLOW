@extends('layout')
@section('title','Formations - Formulaires')
@section('content')
<div class="container-fluid container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Formations - Formulaires</h3>
        <a href="{{ route('formations.formulaires.create') }}" class="btn btn-primary">Ajouter</a>
    </div>

    <form method="get" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ request('nom') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ request('email') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Numéro</label>
                <input type="text" name="numero" class="form-control" value="{{ request('numero') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Type d'opération</label>
                <input type="text" name="type_operation" class="form-control" value="{{ request('type_operation') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <input type="text" name="statut" class="form-control" value="{{ request('statut') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Date d'inscription</label>
                <input type="date" name="date_inscription" class="form-control" value="{{ request('date_inscription') }}">
            </div>
            <div class="col-12 d-flex gap-2 mt-2">
                <button class="btn btn-outline-primary">Filtrer</button>
                <a href="{{ route('formations.formulaires.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
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
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Numéro</th>
                        <th>Critère</th>
                        <th>Diplôme</th>
                        <th>Type opération</th>
                        <th>Paiement</th>
                        <th>Statut</th>
                        <th>Date inscription</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($formulaires as $f)
                        <tr>
                            <td>{{ $f->id }}</td>
                            <td>{{ $f->nom }}</td>
                            <td>{{ $f->email }}</td>
                            <td>{{ $f->numero }}</td>
                            <td>{{ $f->critere }}</td>
                            <td>{{ $f->nom_diplome }}</td>
                            <td>{{ $f->type_operation }}</td>
                            <td>{{ $f->paiement }}</td>
                            <td>{{ $f->statut }}</td>
                            <td>{{ $f->date_inscription }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('formations.formulaires.edit', $f->id) }}" class="btn btn-sm btn-outline-primary">Éditer</a>
                                <form action="{{ route('formations.formulaires.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Supprimer ce formulaire ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">Aucun formulaire trouvé.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(method_exists($formulaires, 'links'))
            <div class="card-footer">{{ $formulaires->links() }}</div>
        @endif
    </div>
</div>
@endsection
