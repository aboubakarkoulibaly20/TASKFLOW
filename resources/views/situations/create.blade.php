@extends('layout')
@section('title','Ajouter une situation')
@section('content')
<div class="container-fluid container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Ajouter une situation</h3>
        <a href="{{ route('situations.index') }}" class="btn btn-secondary">Retour</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('situations.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($clients as $c)
                                <option value="{{ $c->id }}">{{ $c->company ?? ($c->first_name.' '.$c->last_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type impôt</label>
                        <input type="text" name="type_impot" class="form-control" value="{{ old('type_impot') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type sociale</label>
                        <input type="text" name="type_sociale" class="form-control" value="{{ old('type_sociale') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Régime</label>
                        <input type="text" name="regime" class="form-control" value="{{ old('regime') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant</label>
                        <input type="number" step="0.01" name="montant" class="form-control" value="{{ old('montant') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Période</label>
                        <input type="text" name="periode" class="form-control" placeholder="2025-Q1 / 2025-01" value="{{ old('periode') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date de paiement</label>
                        <input type="date" name="date_paiement" class="form-control" value="{{ old('date_paiement') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <input type="text" name="status" class="form-control" value="{{ old('status') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fichier</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('situations.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
