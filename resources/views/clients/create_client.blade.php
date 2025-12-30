@php
    use Illuminate\Support\Facades\DB;

    $lastGeneratedNumber = DB::table('clients')
        ->select('id')
        ->orderBy('id', 'DESC')
        ->first();

    $newNumber = $lastGeneratedNumber->id + 1;
    $formattedNumber = sprintf('DCK-%03d', $newNumber);

    // Récupérer le dernier numéro généré
    $lastGeneratedNumber1 = DB::table('clients')
        ->select('numcga')
        ->orderBy('numcga', 'DESC')
        ->first();

    // Initialiser le nouveau numéro
    $newNumber1 = 1; // Commencer à 001 par défaut
    $currentYear = date('Y');

    if ($lastGeneratedNumber1) {
        // Extraire l'année du dernier numéro
        $lastYear = substr($lastGeneratedNumber1->numcga, 7, 4); // Année à la 8ème position (4 caractères)
        //echo $lastYear;
        // Vérifier si l'année du dernier numéro est la même que l'année actuelle
        if ($lastYear == $currentYear) {
            // Extraire le numéro à la fin du dernier numéro
            $derniersNumeros = intval(substr($lastGeneratedNumber1->numcga, -3)); // Numéro à la fin
            $newNumber1 = $derniersNumeros + 1; // Incrémenter le numéro
        }
    }
    // Formater le nouveau numéro
    $formattedNumber1 = sprintf('DCK-CGA%s-A%03d', $currentYear, $newNumber1);
    //echo "Nouveau numéro ADH : " . $formattedNumber;
@endphp
@extends('layout')
@section('title')
<?= get_label('create_client', 'Créer un client') ?>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2 mt-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{url('home')}}"><?= get_label('home', 'Accueil') ?></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{url('clients')}}"><?= get_label('clients', 'Clients') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('create', 'Créer') ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @role('admin')
    @php
    $account_creation_template = App\Models\Template::where('type', 'email')
        ->where('name', 'account_creation')
        ->first();
    @endphp
    @if (!($account_creation_template) || ($account_creation_template && $account_creation_template->status == 1))
    <div class="alert alert-primary" role="alert">
        {{ get_label('acc_crea_email_enabled_inf', 'Le statut de l\'email de création de compte étant actif, veuillez vous assurer que les paramètres de messagerie sont configurés et opérationnels.') }}
        <a href="{{ url('settings/templates') }}">
            {{ get_label('click_to_change_acc_crea_email_sts', 'Cliquez ici pour modifier le statut de l\'email de création de compte.') }}
        </a>
    </div>
    @endif
    @endrole

    <div class="card">
        <div class="card-body">
            <form action="{{url('clients/store')}}" method="POST" class="form-submit-event" enctype="multipart/form-data">
                <input type="hidden" name="redirect_url" value="{{ url('clients') }}">
                <input type="hidden" name="add_more" value="false" id="add_more">
                @csrf

                <div class="mb-3 col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="internal_client" name="internal_purpose">
                        <label class="form-check-label" for="internal_client"><?= get_label('internal_client', 'Is this a client for internal purpose only?') ?></label>
                        <i class='bx bx-info-circle text-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="<?= get_label('internal_client_info', 'Select this option if you want to create a client for internal use only, without granting account access to the client.') ?>"></i>
                    </div>
                </div>

                <!-- Section Détails du compte -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3 fw-bold text-primary">Détails du compte</h4>
                        <hr>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="formjurid" class="form-label">Forme juridique  <span class="asterisk">*</span></label>
                        <select id="formjurid" name="formjurid" class="form-select" required>
                            <option value="">--</option>
                            <option value="ENTREPRISE INDIVIDUELLE">ENTREPRISE INDIVIDUELLE</option>
                            <option value="SARL">SARL</option>
                            <option value="SAS">SAS</option>
                            <option value="SA">SA</option>
                            <option value="SNC">SNC</option>
                            <option value="NCS">NCS</option>
                            <option value="ONG">ONG</option>
                            <option value="AUTRE">AUTRE</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="category_id" class="form-label">Catégorie client  <span class="asterisk">*</span></label>
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option value="">--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3" id="numadhe" style="display:none;">
                        <label for="numadh1" class="form-label">Numéro Cabinet <span class="asterisk">*</span></label>
                        <input type="text" class="form-control" id="numadh1" name="numadh1" value="{{ $formattedNumber1 }}" readonly>
                        <input type="hidden" name="numadh" id="numadh" value="{{ $formattedNumber }}">
                    </div>

                    <div class="col-md-3 mb-3" id="numcabinet" style="display:none;">
                        <label for="numcga1" class="form-label">Numéro d'adhésion CGA  <span class="asterisk">*</span></label>
                        <input type="text" class="form-control" id="numcga1" name="numcga1" value="{{ $formattedNumber }}" readonly>
                        <input type="hidden" name="numcga" id="numcga" value="{{ $formattedNumber1 }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="exemple@domaine.com" value="{{ old('email') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 8 caractères">
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="bx bx-hide"></i>
                            </button>
                            <button id="random_password" type="button" class="btn btn-outline-secondary" title="Générer mot de passe aléatoire">
                                <i class="bx bxs-magic-wand"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3" id="name_ese">
                        <label for="company_name" class="form-label">Nom de l'entreprise <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nom de l'entreprise" value="{{ old('company_name') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="company_name_com" class="form-label">Nom commercial </label>
                        <input type="text" class="form-control" id="company_name_com" name="company_name_com" placeholder="Nom commercial" value="{{ old('company_name_com') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="country" class="form-label">Pays <span class="asterisk">*</span></label>
                        <select class="form-select" id="country" name="country">
                            <option value="53" selected>Côte d'Ivoire</option>
                            @foreach ($countries as $item)
                                @if($item->iso != 'CI')
                                    <option value="{{ $item->id }}">{{ $item->nicename }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3 ">
                        <label class="form-label">{{ get_label('country_code_and_phone_number', 'Country code and phone number') }}</label>
                        <div class="input-group">
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" data-type="create">
                            <span class="clear-input">×</span>
                        </div>
                        <input type="hidden" name="country_code" id="country_code">
                        <input type="hidden" name="country_iso_code" id="country_iso_code">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="lastName" class="form-label">Nom du dirigeant </label>
                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="<?= get_label('please_enter_last_name', 'Please enter last name') ?>" value="{{ old('last_name') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="firstName" class="form-label">Prénoms du dirigeant</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" placeholder="<?= get_label('please_enter_first_name', 'Please enter first name') ?>" value="{{ old('first_name') }}">
                    </div>
                </div>

                <!-- Section Détails de l'entreprise -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3 fw-bold text-primary">Détails de l'entreprise</h4>
                        <hr>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="numrccm" class="form-label">Numéro RCCM</label>
                        <input type="text" class="form-control" id="numrccm" name="numrccm" placeholder="Numéro RCCM" value="{{ old('tax_name') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="numcc" class="form-label">Numéro Compte Contribuable</label>
                        <input type="text" class="form-control" id="numcc" name="numcc" maxlength="8" placeholder="Compte Contribuable" value="{{ old('gst_number') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="numidu" class="form-label">Numéro IDU</label>
                        <input type="text" class="form-control" id="numidu" name="numidu" placeholder="Numéro IDU" value="{{ old('numidu') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="regime" class="form-label">Régime fiscal</label>
                        <select id="regime" name="regime" class="form-select">
                            <option value="">--</option>
                            <option value="TEE">TEE</option>
                            <option value="RME">RME</option>
                            <option value="RSI">RSI</option>
                            <option value="RNI">RNI</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="imp_centre" class="form-label">Centre des impôts</label>
                        <select id="imp_centre" name="imp_centre" class="form-select">
                            <option value="">--</option>
                            <option value="II Plateaux III">II Plateaux III</option>
                            <option value="II Plateaux Djibi">II Plateaux Djibi</option>
                            <option value="II Plateaux I">II Plateaux I</option>
                            <option value="II Plateaux II">II Plateaux II</option>
                            <option value="Anyama">Anyama</option>
                            <option value="Alepé">Alepé</option>
                            <option value="Abobo II">Abobo II</option>
                            <option value="Abobo III">Abobo III</option>
                            <option value="Adjamé I">Adjamé I</option>
                            <option value="Adjamé II">Adjamé II</option>
                            <option value="Attecoubé">Attecoubé</option>
                            <option value="Adjamé III">Adjamé III</option>
                            <option value="Cocody">Cocody</option>
                            <option value="Williamsville">Williamsville</option>
                            <option value="Plateau I">Plateau I</option>
                            <option value="Plateau II">Plateau II</option>
                            <option value="Yopougon I">Yopougon I</option>
                            <option value="Yopougon II">Yopougon II</option>
                            <option value="Yopougon III">Yopougon III</option>
                            <option value="Yopougon IV">Yopougon IV</option>
                            <option value="Yopougon V">Yopougon V</option>
                            <option value="Bingerville">Bingerville</option>
                            <option value="Riviera I">Riviera I</option>
                            <option value="Riviera II">Riviera II</option>
                            <option value="Port-Bouet">Port-Bouet</option>
                            <option value="Treichville I">Treichville I</option>
                            <option value="Treichville II">Treichville II</option>
                            <option value="Bietry">Bietry</option>
                            <option value="Koumassi I">Koumassi I</option>
                            <option value="Koumassi II">Koumassi II</option>
                            <option value="Marcory I">Marcory I</option>
                            <option value="Marcory II">Marcory II</option>
                            <option value="Zone IV">Zone IV</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="acti_prin" class="form-label">Activités principales</label>
                        <input type="text" class="form-control" id="acti_prin" name="acti_prin" placeholder="Activités principales" value="{{ old('acti_prin') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="section" class="form-label">Section</label>
                        <input type="text" class="form-control" id="section" name="section" placeholder="Section" value="{{ old('section') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="parcelle" class="form-label">Parcelle</label>
                        <input type="text" class="form-control" id="parcelle" name="parcelle" placeholder="Parcelle" value="{{ old('parcelle') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="codeacti" class="form-label">Code activité</label>
                        <input type="text" class="form-control" id="codeacti" name="codeacti" placeholder="Code activité" value="{{ old('codeacti') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="montcapit" class="form-label">Montant du capital</label>
                        <input type="number" class="form-control" id="montcapit" name="montcapit" placeholder="Montant du capital" value="{{ old('montcapit') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Ville" value="{{ old('city') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="state" class="form-label">Sigle</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Sigle" value="{{ old('state') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="zip" class="form-label">Code postal</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Code postal" value="{{ old('zip') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="company_logo" class="form-label">Logo de l'entreprise</label>
                        <input class="form-control" type="file" id="profile" name="profile" accept="image/*">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Localisation (Adresse)</label>
                        <textarea class="form-control" id="address" name="address" rows="1" placeholder="Adresse complète">{{ old('address') }}</textarea>
                    </div>                    
                </div>

                <!-- Section Options -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3 fw-bold text-primary">Options</h4>
                        <hr>
                    </div>

                    <div class="mb-3 col-md-6" id="statusDiv">
                        <label class="form-label" for=""><?= get_label('status', 'Status') ?> (<small class="text-muted mt-2"><?= get_label('deactivated_client_login_restricted', 'If Deactivated, the Client Won\'t Be Able to Log In to Their Account') ?></small>)</label>
                        <div class="">
                            <div class="btn-group btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" id="client_active" name="status" value="1" checked>
                                <label class="btn btn-outline-primary" for="client_active"><?= get_label('active', 'Active') ?></label>
                                <input type="radio" class="btn-check" id="client_deactive" name="status" value="0" >
                                <label class="btn btn-outline-primary" for="client_deactive"><?= get_label('deactive', 'Deactive') ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6" id="requireEvDiv">
                        <label class="form-label" for="">
                            <?= get_label('require_email_verification', 'Require email verification?') ?>
                            <i class='bx bx-info-circle text-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="<?= get_label('client_require_email_verification_info', 'If Yes is selected, client will receive a verification link via email. Please ensure that email settings are configured and operational.') ?>"></i>
                        </label>
                        <div class="">
                            <div class="btn-group btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" id="require_ev_yes" name="require_ev" value="1" >
                                <label class="btn btn-outline-primary" for="require_ev_yes"><?= get_label('yes', 'Yes') ?></label>
                                <input type="radio" class="btn-check" id="require_ev_no" name="require_ev" value="0" checked>
                                <label class="btn btn-outline-primary" for="require_ev_no"><?= get_label('no', 'No') ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Boutons d'action -->
                <div class="row">
                    <div class="col-12" style="text-align: right;">
                        <button type="submit" class="btn btn-primary me-2" id="save-client-form">
                            <i class="fa fa-check me-1"></i>Enregistrer
                        </button>

                        <a href="{{ url('clients') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-times me-1"></i>Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Désactiver les champs de numéros générés automatiquement
    document.getElementById('numcga1').disabled = true;
    document.getElementById('numadh1').disabled = true;

    // Gestion de la forme juridique
    document.getElementById('formjurid').addEventListener('change', function() {
        const formjuridiqueId = this.value;
        const companyNameDiv = document.getElementById('name_ese');
        const companyName = document.getElementById('company_name');
        const companyNameCom = document.getElementById('company_name_com').value;

        if(formjuridiqueId === 'ENTREPRISE INDIVIDUELLE') {
            companyNameDiv.style.display = 'none';
            companyName.value = companyNameCom;
        } else {
            companyNameDiv.style.display = 'block';
        }
    });

    // Gestion de la catégorie client
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const numAdheDiv = document.getElementById('numadhe');
        const numCabinetDiv = document.getElementById('numcabinet');

        if (categoryId === '11') {
            numAdheDiv.style.display = 'none';
            numCabinetDiv.style.display = 'block';
            document.getElementById('numcga').value = document.getElementById('numcga1').value;
            document.getElementById('numadh').value = null;
        } else if (categoryId !== '') {
            numAdheDiv.style.display = 'block';
            numCabinetDiv.style.display = 'none';
            document.getElementById('numcga').value = document.getElementById('numcga1').value;
            document.getElementById('numadh').value = document.getElementById('numadh1').value;
        } else {
            numAdheDiv.style.display = 'none';
            numCabinetDiv.style.display = 'none';
        }
    });

    // Gestion du changement de pays pour le code téléphonique
    document.getElementById('country').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const phonecode = selectedOption.getAttribute('data-phonecode');

        if (phonecode) {
            document.getElementById('country_phonecode').value = '+' + phonecode;
        }
    });

    // Générateur de mot de passe aléatoire
    document.getElementById('random_password').addEventListener('click', function() {
        const randPassword = Math.random().toString(36).substr(2, 8);
        document.getElementById('password').value = randPassword;
    });

    // Toggle affichage du mot de passe
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Gestion des boutons de sauvegarde
    document.getElementById('save-more-client-form').addEventListener('click', function() {
        document.getElementById('add_more').value = 'true';
        document.querySelector('form').submit();
    });
});
</script>

@endsection
