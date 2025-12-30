<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un formulaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Ajouter un formulaire</h3>
        <a href="{{ route('formations.formulaires.index') }}" class="btn btn-secondary">Retour</a>
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
            <form action="{{ route('formations.formulaires.store') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Numéro</label>
                        <input type="text" name="numero" class="form-control" value="{{ old('numero') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Critère</label>
                        <input type="text" name="critere" class="form-control" value="{{ old('critere') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom du diplôme</label>
                        <input type="text" name="nom_diplome" class="form-control" value="{{ old('nom_diplome') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type d'opération</label>
                        <input type="text" name="type_operation" class="form-control" value="{{ old('type_operation') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Paiement</label>
                        <input type="text" name="paiement" class="form-control" value="{{ old('paiement') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Statut</label>
                        <input type="text" name="statut" class="form-control" value="{{ old('statut') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date d'inscription</label>
                        <input type="date" name="date_inscription" class="form-control" value="{{ old('date_inscription') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Commentaire</label>
                        <textarea name="commentaire" class="form-control" rows="3">{{ old('commentaire') }}</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('formations.formulaires.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
