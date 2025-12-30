@extends('layout')
@section('title','Éditer une situation')
@section('content')
<div class="container-fluid container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Éditer une situation</h3>
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
            <form action="{{ route('situations.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $situation->id }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-select" required>
                            @foreach($clients as $c)
                                <option value="{{ $c->id }}" {{ $situation->client_id==$c->id?'selected':'' }}>{{ $c->company ?? ($c->first_name.' '.$c->last_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type impôt</label>
                        <input type="text" name="type_impot" class="form-control" value="{{ old('type_impot',$situation->type_impot) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type sociale</label>
                        <input type="text" name="type_sociale" class="form-control" value="{{ old('type_sociale',$situation->type_sociale) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Régime</label>
                        <input type="text" name="regime" class="form-control" value="{{ old('regime',$situation->regime) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant</label>
                        <input type="number" step="0.01" name="montant" class="form-control" value="{{ old('montant',$situation->montant) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Période</label>
                        <input type="text" name="periode" class="form-control" value="{{ old('periode',$situation->periode) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date de paiement</label>
                        <input type="date" name="date_paiement" class="form-control" value="{{ old('date_paiement',$situation->date_paiement) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <input type="text" name="status" class="form-control" value="{{ old('status',$situation->status) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fichier (laisser vide pour conserver)</label>
                        <input type="file" name="file" class="form-control">
                        @if($situation->file)
                            <small class="text-muted">Actuel: <a href="{{ asset('storage/'.$situation->file) }}" target="_blank">Voir</a></small>
                        @endif
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('situations.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
