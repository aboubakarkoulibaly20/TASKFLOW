@extends('layout')
@section('title')
<?= get_label('update_client_profile', 'Update client profile') ?>
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2 mt-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{url('home')}}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{url('clients')}}"><?= get_label('clients', 'Clients') ?></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{url('clients/profile/'.$client->id)}}">{{$client->first_name.' '.$client->last_name}}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('update', 'Update') ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{url('clients/update/' . $client->id)}}" method="POST" class="form-submit-event" enctype="multipart/form-data">
                <input type="hidden" name="redirect_url" value="{{ url('clients') }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-md-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="update_internal_client" name="internal_purpose" {{$client->internal_purpose==1?'checked':''}}>
                            <label class="form-check-label" for="update_internal_client"><?= get_label('internal_client', 'Is this a client for internal purpose only?') ?></label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="first_name" class="form-label"><?= get_label('first_name', 'First name') ?> <span class="asterisk">*</span></label>
                        <input class="form-control" type="text" id="first_name" name="first_name" placeholder="<?= get_label('please_enter_first_name', 'Please enter first name') ?>" value="{{ $client->first_name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="last_name" class="form-label"><?= get_label('last_name', 'Last name') ?> <span class="asterisk">*</span></label>
                        <input class="form-control" type="text" name="last_name" placeholder="<?= get_label('please_enter_last_name', 'Please enter last name') ?>" id="last_name" value="{{ $client->last_name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label"><?= get_label('email', 'E-mail') ?> <span class="asterisk">*</span></label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="<?= get_label('please_enter_email', 'Please enter email') ?>" value="{{ $client->email }}" autocomplete="off">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">{{ get_label('country_code_and_phone_number', 'Country code and phone number') }}</label>
                        <div class="input-group">
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ $client->phone }}">
                            <span class="clear-input">Ã—</span>
                        </div>
                        <input type="hidden" name="country_code" id="country_code" value="{{ $client->country_code }}">
                        <input type="hidden" name="country_iso_code" id="country_iso_code" value="{{ $client->country_iso_code }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="company_name_com" class="form-label">Nom commercial <span class="asterisk">*</span></label>
                        <input class="form-control" type="text" id="company_name_com" name="company_name_com" placeholder="Nom commercial" value="{{ $client->company_name_com }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="formjurid" class="form-label">Forme juridique <span class="asterisk">*</span></label>
                        <select id="formjurid" name="formjurid" class="form-select">
                            <option value="">--</option>
                            <option value="ENTREPRISE INDIVIDUELLE" {{ $client->formjurid=='ENTREPRISE INDIVIDUELLE'?'selected':'' }}>ENTREPRISE INDIVIDUELLE</option>
                            <option value="SARL" {{ $client->formjurid=='SARL'?'selected':'' }}>SARL</option>
                            <option value="SAS" {{ $client->formjurid=='SAS'?'selected':'' }}>SAS</option>
                            <option value="SA" {{ $client->formjurid=='SA'?'selected':'' }}>SA</option>
                            <option value="SNC" {{ $client->formjurid=='SNC'?'selected':'' }}>SNC</option>
                            <option value="NCS" {{ $client->formjurid=='NCS'?'selected':'' }}>NCS</option>
                            <option value="ONG" {{ $client->formjurid=='ONG'?'selected':'' }}>ONG</option>
                            <option value="AUTRE" {{ $client->formjurid=='AUTRE'?'selected':'' }}>AUTRE</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="category_id" class="form-label">Catégorie client <span class="asterisk">*</span></label>
                        <select class="form-select" name="category_id" id="category_id">
                            <option value="">--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $client->category_id==$category->id?'selected':'' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="numadh" class="form-label">Numéro d'adhésion CGA</label>
                        <input class="form-control" type="text" id="numadh" name="numadh" value="{{ $client->numadh }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="numcga" class="form-label">Numéro Cabinet</label>
                        <input class="form-control" type="text" id="numcga" name="numcga" value="{{ $client->numcga }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="numrccm" class="form-label">Numéro RCCM</label>
                        <input type="text" class="form-control" id="numrccm" name="numrccm" placeholder="Numéro RCCM" value="{{ $client->numrccm }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="numcc" class="form-label">Numéro Compte Contribuable</label>
                        <input type="text" class="form-control" id="numcc" name="numcc" maxlength="8" placeholder="Compte Contribuable" value="{{ $client->numcc }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="numidu" class="form-label">Numéro IDU</label>
                        <input type="text" class="form-control" id="numidu" name="numidu" placeholder="Numéro IDU" value="{{ $client->numifg }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="regime" class="form-label">Régime fiscal</label>
                        <select id="regime" name="regime" class="form-select">
                            <option value="">--</option>
                            <option value="TEE" {{ $client->regime=='TEE'?'selected':'' }}>TEE</option>
                            <option value="RME" {{ $client->regime=='RME'?'selected':'' }}>RME</option>
                            <option value="RSI" {{ $client->regime=='RSI'?'selected':'' }}>RSI</option>
                            <option value="RNI" {{ $client->regime=='RNI'?'selected':'' }}>RNI</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="imp_centre" class="form-label">Centre des impôts</label>
                        <select id="imp_centre" name="imp_centre" class="form-select">
                            <option value="">--</option>
                            <option value="II Plateaux III" {{ $client->imp_centre=='II Plateaux III'?'selected':'' }}>II Plateaux III</option>
                            <option value="II Plateaux Djibi" {{ $client->imp_centre=='II Plateaux Djibi'?'selected':'' }}>II Plateaux Djibi</option>
                            <option value="II Plateaux I" {{ $client->imp_centre=='II Plateaux I'?'selected':'' }}>II Plateaux I</option>
                            <option value="II Plateaux II" {{ $client->imp_centre=='II Plateaux II'?'selected':'' }}>II Plateaux II</option>
                            <option value="Anyama" {{ $client->imp_centre=='Anyama'?'selected':'' }}>Anyama</option>
                            <option value="Alepé" {{ $client->imp_centre=='Alepé'?'selected':'' }}>Alepé</option>
                            <option value="Abobo II" {{ $client->imp_centre=='Abobo II'?'selected':'' }}>Abobo II</option>
                            <option value="Abobo III" {{ $client->imp_centre=='Abobo III'?'selected':'' }}>Abobo III</option>
                            <option value="Adjamé I" {{ $client->imp_centre=='Adjamé I'?'selected':'' }}>Adjamé I</option>
                            <option value="Adjamé II" {{ $client->imp_centre=='Adjamé II'?'selected':'' }}>Adjamé II</option>
                            <option value="Attecoubé" {{ $client->imp_centre=='Attecoubé'?'selected':'' }}>Attecoubé</option>
                            <option value="Adjamé III" {{ $client->imp_centre=='Adjamé III'?'selected':'' }}>Adjamé III</option>
                            <option value="Cocody" {{ $client->imp_centre=='Cocody'?'selected':'' }}>Cocody</option>
                            <option value="Williamsville" {{ $client->imp_centre=='Williamsville'?'selected':'' }}>Williamsville</option>
                            <option value="Plateau I" {{ $client->imp_centre=='Plateau I'?'selected':'' }}>Plateau I</option>
                            <option value="Plateau II" {{ $client->imp_centre=='Plateau II'?'selected':'' }}>Plateau II</option>
                            <option value="Yopougon I" {{ $client->imp_centre=='Yopougon I'?'selected':'' }}>Yopougon I</option>
                            <option value="Yopougon II" {{ $client->imp_centre=='Yopougon II'?'selected':'' }}>Yopougon II</option>
                            <option value="Yopougon III" {{ $client->imp_centre=='Yopougon III'?'selected':'' }}>Yopougon III</option>
                            <option value="Yopougon IV" {{ $client->imp_centre=='Yopougon IV'?'selected':'' }}>Yopougon IV</option>
                            <option value="Yopougon V" {{ $client->imp_centre=='Yopougon V'?'selected':'' }}>Yopougon V</option>
                            <option value="Bingerville" {{ $client->imp_centre=='Bingerville'?'selected':'' }}>Bingerville</option>
                            <option value="Riviera I" {{ $client->imp_centre=='Riviera I'?'selected':'' }}>Riviera I</option>
                            <option value="Riviera II" {{ $client->imp_centre=='Riviera II'?'selected':'' }}>Riviera II</option>
                            <option value="Port-Bouet" {{ $client->imp_centre=='Port-Bouet'?'selected':'' }}>Port-Bouet</option>
                            <option value="Treichville I" {{ $client->imp_centre=='Treichville I'?'selected':'' }}>Treichville I</option>
                            <option value="Treichville II" {{ $client->imp_centre=='Treichville II'?'selected':'' }}>Treichville II</option>
                            <option value="Bietry" {{ $client->imp_centre=='Bietry'?'selected':'' }}>Bietry</option>
                            <option value="Koumassi I" {{ $client->imp_centre=='Koumassi I'?'selected':'' }}>Koumassi I</option>
                            <option value="Koumassi II" {{ $client->imp_centre=='Koumassi II'?'selected':'' }}>Koumassi II</option>
                            <option value="Marcory I" {{ $client->imp_centre=='Marcory I'?'selected':'' }}>Marcory I</option>
                            <option value="Marcory II" {{ $client->imp_centre=='Marcory II'?'selected':'' }}>Marcory II</option>
                            <option value="Zone IV" {{ $client->imp_centre=='Zone IV'?'selected':'' }}>Zone IV</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="acti_prin" class="form-label">Activités principales</label>
                        <input type="text" class="form-control" id="acti_prin" name="acti_prin" placeholder="Activités principales" value="{{ $client->acti_prin }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="section" class="form-label">Section</label>
                        <input type="text" class="form-control" id="section" name="section" placeholder="Section" value="{{ $client->section }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="parcelle" class="form-label">Parcelle</label>
                        <input type="text" class="form-control" id="parcelle" name="parcelle" placeholder="Parcelle" value="{{ $client->parcelle }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="codeacti" class="form-label">Code activité</label>
                        <input type="text" class="form-control" id="codeacti" name="codeacti" placeholder="Code activité" value="{{ $client->codeacti }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="montcapit" class="form-label">Montant du capital</label>
                        <input type="number" class="form-control" id="montcapit" name="montcapit" placeholder="Montant du capital" value="{{ $client->montcapit }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="company" class="form-label"><?= get_label('company', 'Company') ?></label>
                        <input class="form-control" type="text" id="company" name="company" placeholder="<?= get_label('please_enter_company_name', 'Please enter company name') ?>" value="{{ $client->company }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label"><?= get_label('address', 'Address') ?></label>
                        <input class="form-control" type="text" id="address" name="address" placeholder="<?= get_label('please_enter_address', 'Please enter address') ?>" value="{{ $client->address }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label"><?= get_label('city', 'City') ?></label>
                        <input class="form-control" type="text" id="city" name="city" placeholder="<?= get_label('please_enter_city', 'Please enter city') ?>" value="{{ $client->city }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label"><?= get_label('state', 'State') ?></label>
                        <input class="form-control" type="text" id="state" name="state" placeholder="<?= get_label('please_enter_state', 'Please enter state') ?>" value="{{ $client->state }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label"><?= get_label('country', 'Country') ?></label>
                        <select class="form-select" id="country" name="country">
                            @foreach ($countries as $item)
                                <option value="{{ $item->id }}" {{ ($client->country == $item->nicename) ? 'selected' : '' }}>{{ $item->nicename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="zip" class="form-label"><?= get_label('zip_code', 'Zip code') ?></label>
                        <input class="form-control" type="text" id="zip" name="zip" placeholder="<?= get_label('please_enter_zip_code', 'Please enter ZIP code') ?>" value="{{ $client->zip }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="dob" class="form-label"><?= get_label('date_of_birth', 'Date of birth') ?></label>
                        <input class="form-control" type="text" id="dob" name="dob" value="{{ $client->dob?format_date($client->dob) : ''}}" placeholder="<?= get_label('please_select', 'Please select') ?>" autocomplete="off">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="doj" class="form-label"><?= get_label('date_of_joining', 'Date of joining') ?></label>
                        <input class="form-control" type="text" id="doj" name="doj" value="{{ $client->doj?format_date($client->doj) : ''}}" placeholder="<?= get_label('please_select', 'Please select') ?>" autocomplete="off">
                    </div>
                    @if(isAdminOrHasAllDataAccess())
                    <div class="mb-3 col-md-6 {{$client->internal_purpose==1?'d-none':''}} form-password-toggle" id="passDiv">
                        <label for="password" class="form-label">
                            <?= get_label('password', 'Password') ?>
                            @if ($client->password !== null)
                            <small class="text-muted"> (({{get_label('leave_blank_if_no_change', 'Leave it blank if no change')}}))</small>
                            @else
                            <span class="asterisk">*</span>
                            @endif
                        </label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="password" name="password" placeholder="<?= get_label('please_enter_password', 'Please enter password') ?>" autocomplete="new-password">
                            <span class="input-group-text cursor-pointer toggle-password"><i class="bx bx-hide"></i></span>
                            <span class="input-group-text cursor-pointer" id="generate-password"><i class="bx bxs-magic-wand"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 {{$client->internal_purpose==1?'d-none':''}} form-password-toggle" id="confirmPassDiv">
                        <label for="password_confirmation" class="form-label"><?= get_label('confirm_password', 'Confirm password') ?>
                            @if ($client->password === null)
                            <span class="asterisk">*</span>
                            @endif
                        </label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="<?= get_label('please_re_enter_password', 'Please re enter password') ?>" autocomplete="new-password">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3 col-md-6">
                        <label for="photo" class="form-label"><?= get_label('profile_picture', 'Profile picture') ?></label>
                        <div class="d-flex gap-4">
                            <img src="{{$client->photo ? asset('storage/' . $client->photo) : asset('storage/photos/no-image.jpg')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <div class="input-group d-flex">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="profile">
                                </div>                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 col-md-6 {{$client->internal_purpose==1?'d-none':''}}" id="statusDiv">
                        <label class="form-label" for=""><?= get_label('status', 'Status') ?> (<small class="text-muted mt-2"><?= get_label('deactivated_client_login_restricted', 'If Deactivated, the Client Won\'t Be Able to Log In to Their Account') ?></small>)</label>
                        <div class="">
                            <div class="btn-group btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" id="client_active" name="status" value="1" <?= $client->status == 1 ? 'checked' : '' ?>>
                                <label class="btn btn-outline-primary" for="client_active"><?= get_label('active', 'Active') ?></label>
                                <input type="radio" class="btn-check" id="client_deactive" name="status" value="0" <?= $client->status == 0 ? 'checked' : '' ?>>
                                <label class="btn btn-outline-primary" for="client_deactive"><?= get_label('deactive', 'Deactive') ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 {{$client->internal_purpose==1?'d-none':''}}" id="requireEvDiv">
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
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2" id="submit_btn"><?= get_label('update', 'Update') ?></button>
                        <button type="reset" class="btn btn-outline-secondary"><?= get_label('cancel', 'Cancel') ?></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
