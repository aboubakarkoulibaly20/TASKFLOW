@extends('layout')
@section('title','Éditer une inscription')
@section('content')
<div class="container-fluid container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Éditer une inscription</h3>
        <a href="{{ route('formations.registrations.index') }}" class="btn btn-secondary">Retour</a>
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
            <form action="{{ route('formations.registrations.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $registration->id }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="nom_complet" class="form-control" value="{{ old('nom_complet',$registration->nom_complet) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email',$registration->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="{{ old('telephone',$registration->telephone) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nombre de tickets</label>
                        <input type="number" min="1" name="nombre_tickets" class="form-control" value="{{ old('nombre_tickets',$registration->nombre_tickets) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant</label>
                        <input type="number" step="0.01" name="montant" class="form-control" value="{{ old('montant',$registration->montant) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Devise</label>
                        <input type="text" name="devise" class="form-control" value="{{ old('devise',$registration->devise) }}" placeholder="ex: EUR, USD">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Statut</label>
                        <input type="text" name="statut" class="form-control" value="{{ old('statut',$registration->statut) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date inscription</label>
                        <input type="date" name="date_inscription" class="form-control" value="{{ old('date_inscription',$registration->date_inscription) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Méthode de paiement</label>
                        <input type="text" name="methode_paiement" class="form-control" value="{{ old('methode_paiement',$registration->methode_paiement) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Référence paiement</label>
                        <input type="text" name="reference_paiement" class="form-control" value="{{ old('reference_paiement',$registration->reference_paiement) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de paiement</label>
                        <input type="date" name="date_paiement" class="form-control" value="{{ old('date_paiement',$registration->date_paiement) }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Commentaire admin</label>
                        <textarea name="commentaire_admin" class="form-control" rows="3">{{ old('commentaire_admin',$registration->commentaire_admin) }}</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('formations.registrations.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
