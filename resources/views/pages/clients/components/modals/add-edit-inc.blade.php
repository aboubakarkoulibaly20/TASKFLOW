<!--modal-->
@php
$tax_centers = [
    '--', 'II Plateaux III', 'II Plateaux Djibi', 'II Plateaux I', 'II Plateaux II', 'Anyama', 'Alepé', 'Abobo II', 'Abobo III', 'Adjamé I', 'Adjamé II', 'Attecoubé', 'Adjamé III', 'Cocody', 'Williamsvile', 'Plateau I', 'Plateau II', 'Yopougon I', 'Yopougon III', 'Yopougon V', 'Yopougon IV', 'Bingerville', 'Riviera I', 'Riviera II', 'Port-Bouet', 'Treichville I', 'Treichville II', 'Bietry', 'Koumassi I', 'Koumassi II', 'Marcory I', 'Marcory II', 'Zone IV', 'Abengourou', 'Agnibilekro', 'Betié', 'Niablé', 'Aboisso', 'Adiaké', 'Bonoua', 'Grand Bassam', 'Tiapoum', 'Adzopé', 'Agboville', 'Akoupé', 'Taabo', 'Tiassalé', 'Yakassé', 'Bondoukou', 'Doropo', 'Koun Fao', 'Kouassi-Datékro', 'Nassian', 'Tanda', 'Bouaké I', 'Dabakala', 'katiola', 'M’Bahiakro', 'Niakara', 'Bouaké II', 'béoumi', 'Sakassou', 'Dabou', 'Grand Lahou', 'Jacqueville', 'Sikensi', 'Songon', 'Daloa I', 'Daloa II', 'Issia', 'Mankono', 'Seguela', 'Vavoua', 'Arrah', 'Bocanda', 'Bongouanou', 'Dimbokro', 'Daoukro', 'M’Batto', 'Divo', 'Gagnoa', 'Oumé', 'Guiglo', 'Boundiali', 'Dikodougou', 'Ferkessedougou', 'kong', 'Korhogo', 'M’Bengue', 'Ouangolodougou', 'Tengrela', 'Odienne', 'Touba', 'Man', 'Danane', 'Bangolo', 'Fresco', 'San pedro I', 'San pedro II', 'Tabou', 'Soubre', 'Bouafle', 'Tiebissou', 'Toumodi', 'Youmoussoukro', 'Zeunoula'
];
sort($tax_centers);
@endphp
<div class="row" id="js-trigger-clients-modal-add-edit" data-payload="{{ $page['section'] ?? '' }}">
    <div class="col-lg-12">

        <div class="row">
            <!-- LEFT COLUMN: Détails du Compte -->
            <div class="row-lg-6 p-20 border-right">
                <h4 class="card-title m-b-20"><strong><i class="sl-icon-user"></i> {{ cleanLang(__('Details du compte')) }}</strong></h4>

                <!-- Line 1: Catégorie de client | Forme Juridique | Email -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label required">{{ cleanLang(__('lang.category')) }}*</label>
                        <div class="input-group input-group-sm">
                            <select class="select2-basic form-control form-control-sm" id="client_categoryid" name="client_categoryid">
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ runtimePreselected($client->client_categoryid ?? '', $category->category_id) }}>{{ runtimeLang($category->category_name) }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-outline-info edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                                    data-toggle="modal" data-target="#actionsModal" data-url="{{ url('categories/create?type=client&source=ext&target_modal=actionsModal') }}">
                                    <i class="sl-icon-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">Forme Juridique</label>
                        <select class="select2-basic form-control form-control-sm" name="client_custom_field_3">
                            <option value="SARL" {{ runtimePreselected($client->client_custom_field_3 ?? '', 'SARL') }}>SARL</option>
                            <option value="SA" {{ runtimePreselected($client->client_custom_field_3 ?? '', 'SA') }}>SA</option>
                            <option value="EURL" {{ runtimePreselected($client->client_custom_field_3 ?? '', 'EURL') }}>EURL</option>
                            <option value="SAS" {{ runtimePreselected($client->client_custom_field_3 ?? '', 'SAS') }}>SAS</option>
                            <option value="SCI" {{ runtimePreselected($client->client_custom_field_3 ?? '', 'SCI') }}>SCI</option>
                            <option value="Auto-entrepreneur" {{ runtimePreselected($client->client_custom_field_3 ?? '', 'Auto-entrepreneur') }}>Auto-entrepreneur</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label required">{{ cleanLang(__('lang.email_address')) }}*</label>
                        <input type="text" class="form-control form-control-sm" id="email" name="client_email" value="{{ $client->client_email ?? '' }}" placeholder="">
                    </div>
                </div>

                <!-- Line 2:  | Mot de passe | Company Name | Commercial Name-->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">Mot de passe</label>
                        <div class="input-group input-group-sm">
                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-secondary" type="button" id="togglePassword"><i class="sl-icon-eye"></i></button>
                                <button class="btn btn-sm btn-outline-info" type="button" id="generatePassword"><i class="sl-icon-energy"></i></button>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label required">{{ cleanLang(__('Nom de l\'entreprise')) }}*</label>
                        <input type="text" class="form-control form-control-sm" id="client_company_name" name="client_company_name" value="{{ $client->client_company_name ?? '' }}">
                    </div>
                     <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">Nom commercial</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_9" value="{{ $client->client_custom_field_9 ?? '' }}">
                    </div>
                </div>

                

                <!-- Line 4: Gender | Salutation | Nom du Dirigeant -->
                <div class="form-group row">
                   <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">Genre</label>
                        <select class="select2-basic form-control form-control-sm" name="client_custom_field_1">
                            <option value="Homme" {{ runtimePreselected($client->client_custom_field_1 ?? '', 'Homme') }}>Homme</option>
                            <option value="Femme" {{ runtimePreselected($client->client_custom_field_1 ?? '', 'Femme') }}>Femme</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">Salutation</label>
                        <select class="select2-basic form-control form-control-sm" name="client_custom_field_2">
                            <option value="M." {{ runtimePreselected($client->client_custom_field_2 ?? '', 'M.') }}>M.</option>
                            <option value="Mme" {{ runtimePreselected($client->client_custom_field_2 ?? '', 'Mme') }}>Mme</option>
                            <option value="Dr" {{ runtimePreselected($client->client_custom_field_2 ?? '', 'Dr') }}>Dr</option>
                            <option value="Prof" {{ runtimePreselected($client->client_custom_field_2 ?? '', 'Prof') }}>Prof</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label col-form-label">Nom du Dirigeant</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_10" value="{{ $client->client_custom_field_10 ?? '' }}">
                    </div>
                   
                </div>


                <!-- Line 5: Pays | Mobile -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-5">
                        <label class="control-label col-form-label">{{ cleanLang(__('lang.country')) }}</label>
                        <select class="select2-basic-with-search form-control form-control-sm" id="client_billing_country" name="client_billing_country">
                            <option></option>
                            @php $selected_country = $client->client_billing_country ?? ''; @endphp
                            @include('misc.country-list')
                        </select>
                    </div>
                    <div class="col-sm-12 col-lg-7">
                        <label class="control-label col-form-label" id="mobile_label">Mobile</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend" style="min-width: 75px;">
                                <select class="form-control form-control-sm" id="phone_prefix_select" name="phone_prefix_select" style="min-width: 70px; font-size: 0.8rem; padding: 0.2rem;">
                                    <option value="">+...</option>
                                    <option value="+225">+225</option>
                                    <option value="+226">+226</option>
                                    <option value="+223">+223</option>
                                    <option value="+221">+221</option>
                                    <option value="+229">+229</option>
                                    <option value="+228">+228</option>
                                    <option value="+237">+237</option>
                                    <option value="+227">+227</option>
                                    <option value="+212">+212</option>
                                    <option value="+33">+33</option>
                                    <option value="+1">+1</option>
                                    <option value="+44">+44</option>
                                    <option value="+49">+49</option>
                                    <option value="+34">+34</option>
                                    <option value="+39">+39</option>
                                    <option value="+31">+31</option>
                                    <option value="+41">+41</option>
                                    <option value="+351">+351</option>
                                    <option value="+32">+32</option>
                                    <option value="+352">+352</option>
                                </select>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="client_phone" name="client_phone" value="{{ $client->client_phone ?? '' }}" style="flex: 1;">
                        </div>
                    </div>
                </div>

                <!-- Line 8: Radios -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-6">
                        <label class="control-label col-form-label">Connexion autorisée ?</label>
                        <div class="p-t-5">
                            <input type="radio" id="conn_yes" name="client_custom_field_12" value="Oui" class="with-gap radio-col-light-blue" {{ runtimePreselected($client->client_custom_field_12 ?? 'Oui', 'Oui') }}>
                            <label for="conn_yes">Oui</label>
                            <input type="radio" id="conn_no" name="client_custom_field_12" value="Non" class="with-gap radio-col-light-blue" {{ runtimePreselected($client->client_custom_field_12 ?? '', 'Non') }}>
                            <label for="conn_no">Non</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label class="control-label col-form-label">Recevoir notifications ?</label>
                        <div class="p-t-5">
                            <input type="radio" id="notif_yes" name="client_custom_field_13" value="Oui" class="with-gap radio-col-light-blue" {{ runtimePreselected($client->client_custom_field_13 ?? 'Oui', 'Oui') }}>
                            <label for="notif_yes">Oui</label>
                            <input type="radio" id="notif_no" name="client_custom_field_13" value="Non" class="with-gap radio-col-light-blue" {{ runtimePreselected($client->client_custom_field_13 ?? '', 'Non') }}>
                            <label for="notif_no">Non</label>
                        </div>
                    </div>
                </div>

                <!-- Profile Photo / Logo -->
                <div class="form-group row m-t-20">
                    <div class="col-sm-12">
                        <label class="control-label col-form-label">Photo de profil / Logo</label>
                        <div class="dropzone dz-clickable" id="client_logo_upload" style="min-height: 100px; padding: 10px;">
                            <div class="dz-default dz-message">
                                <span><i class="sl-icon-cloud-upload"></i> Glisser-déposer ou cliquer pour télécharger</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

            <!-- RIGHT COLUMN: Détails de l'entreprise -->
           
            <div class="col-12 p-20">
                <h4 class="card-title m-b-20"><strong><i class="sl-icon-briefcase"></i> {{ cleanLang(__('lang.company_details')) }}</strong></h4>

                <!-- Line 1: Site officiel | Numéro compte contribuable | Centre des impôts -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Site officiel')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_website" value="{{ $client->client_website ?? '' }}" placeholder="https://www.exemple.com">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Numéro RCCM')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_vat" value="{{ $client->client_vat ?? '' }}" placeholder="Numéro RCCM">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('N°compte contribuable')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_vat" value="{{ $client->client_vat ?? '' }}" placeholder="Numéro compte contribuable">
                    </div>
                    
                    
                </div>

                <!-- Line 2: Activités principales | Section | Parcelle -->
                <div class="form-group row">
                    <!--Numero IDU-->
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">Numéro IDU</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_5" value="{{ $client->client_custom_field_5 ?? '' }}" placeholder="Numéro IDU">
                    </div>
                    <!--Centre des impôts-->
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Centre des impôts')) }}</label>
                        <select class="select2-basic form-control form-control-sm" name="client_custom_field_21">
    @foreach($tax_centers as $center)
    <option value="{{ $center }}" {{ runtimePreselected($client->client_custom_field_21 ?? '', $center) }}>{{ $center }}</option>
    @endforeach
</select>
                    </div>
                    <!--Fiscalité (Régime Fiscal)-->
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Régime Fiscal')) }}</label>
                        <select class="select2 form-control form-control-sm" name="client_custom_field_14">
                            <option value="--"></option>
                            <option value="TEE" {{ runtimePreselected($client->client_custom_field_14 ?? '', 'TEE') }}>TEE</option>
                            <option value="RME" {{ runtimePreselected($client->client_custom_field_14 ?? '', 'RME') }}>RME</option>
                            <option value="RSI" {{ runtimePreselected($client->client_custom_field_14 ?? '', 'RSI') }}>RSI</option>
                            <option value="RNI" {{ runtimePreselected($client->client_custom_field_14 ?? '', 'RNI') }}>RNI</option>
                        </select>
                    </div>
                   
                </div>
                <div class="form-group row">
                    <!--Activités principales-->
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Activités principales')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_15" value="{{ $client->client_custom_field_15 ?? '' }}" placeholder="Activités principales">
                    </div>
                   <!--Section-->
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Section')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_16" value="{{ $client->client_custom_field_16 ?? '' }}" placeholder="Section">
                    </div>
                    <!--Parcelle-->
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Parcelle')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_17" value="{{ $client->client_custom_field_17 ?? '' }}" placeholder="Parcelle">
                    </div>
                </div>

                <!-- Line 3: Code activité | Montant du capital | Numéro de téléphone du bureau -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Code activité')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_18" value="{{ $client->client_custom_field_18 ?? '' }}" placeholder="Code activité">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Montant du capital')) }}</label>
                        <input type="number" class="form-control form-control-sm" name="client_custom_field_19" value="{{ $client->client_custom_field_19 ?? '' }}" placeholder="Montant du capital">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('N° de téléphone du bureau')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_11" value="{{ $client->client_custom_field_11 ?? '' }}" placeholder="N° de téléphone du bureau">
                    </div>
                </div>

                <!-- Line 4: Sigle | Code Postal | Ajoutée Par -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('lang.city')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_20" value="{{ $client->client_custom_field_20 ?? '' }}" placeholder="New York, Jaipur, Dubaï">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('Sigle')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_custom_field_20" value="{{ $client->client_custom_field_20 ?? '' }}" placeholder="Sigle">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label class="control-label col-form-label">{{ cleanLang(__('lang.zipcode')) }}</label>
                        <input type="text" class="form-control form-control-sm" name="client_billing_zip" value="{{ $client->client_billing_zip ?? '' }}" placeholder="par exemple. 90250">
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-6">
                        <label class="control-label col-form-label">{{ cleanLang(__('Ajoutée Par')) }}</label>
                        <select class="select2 form-control form-control-sm" name="client_creatorid" disabled> <!-- Read-only for now as changing creator is complex -->
                            <option value="{{ $client->client_creatorid ?? auth()->id() }}">{{ \App\Models\User::find($client->client_creatorid ?? auth()->id())->first_name ?? 'Utilisateur' }}</option>
                        </select>
                    </div>
                </div>

                <!-- Line 5: Localisation (Adresse) | Adresse de livraison -->
                <div class="form-group row">
                    <div class="col-sm-12 col-lg-6">
                        <label class="control-label col-form-label">{{ cleanLang(__('Localisation (Adresse)')) }}</label>
                        <textarea class="form-control form-control-sm h-auto" rows="3" name="client_billing_street" placeholder="par exemple. 132, My Street, Kingston, New York 12401">{{ $client->client_billing_street ?? '' }}</textarea>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label class="control-label col-form-label">{{ cleanLang(__('Adresse de livraison')) }}</label>
                        <textarea class="form-control form-control-sm h-auto" rows="3" name="client_shipping_street" placeholder="par exemple. 132, My Street, Kingston, New York 12401">{{ $client->client_shipping_street ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- HIDDEN SECTIONS (Modules, etc.) -->
        <div class="row m-t-30">
            <div class="col-lg-12">
                <div class="spacer row">
                    <div class="col-sm-12 col-lg-8">
                        <span class="title">{{ cleanLang(__('lang.description_and_details')) }}</span class="title">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="switch  text-right">
                            <label>
                                <input type="checkbox" class="js-switch-toggle-hidden-content"
                                    data-target="edit_client_description_toggle">
                                <span class="lever switch-col-light-blue"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="edit_client_description_toggle">
                    <textarea id="client_description" name="client_description"
                        class="tinymce-textarea">{{ $client->client_description ?? '' }}</textarea>
                </div>

                <!-- Modules & Tags toggle (Optional display) -->
                @if(auth()->user()->is_team)
                <div class="spacer row">
                    <div class="col-sm-12 col-lg-8">
                        <span class="title">{{ cleanLang(__('lang.app_modules')) }}</span class="title">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="switch  text-right">
                            <label>
                                <input type="checkbox" name="add_client_option_other" id="add_client_option_other"
                                    class="js-switch-toggle-hidden-content" data-target="client_app_modules_collaped">
                                <span class="lever switch-col-light-blue"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="client_app_modules_collaped" class="hidden">
                    @include('pages.clients.components.modals.modules-inc') 
                </div>
                @endif
            </div>
        </div>

        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('#togglePassword').on('click', function() {
            const pwdIdx = $('#password');
            const type = pwdIdx.attr('type') === 'password' ? 'text' : 'password';
            pwdIdx.attr('type', type);
            $(this).find('i').toggleClass('sl-icon-eye sl-icon-eye-off');
        });

        // Generate random password
        $('#generatePassword').on('click', function() {
            const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
            let pass = "";
            for (let i = 0; i < 10; i++) {
                pass += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            $('#password').val(pass).attr('type', 'text');
            $('#togglePassword').find('i').removeClass('sl-icon-eye').addClass('sl-icon-eye-off');
        });

        // Country Mapping - Extended with more countries
        const countryMapping = {
            "Afghanistan": { prefix: "+93", currency: "AFN" },
            "Algeria": { prefix: "+213", currency: "DZD" },
            "Angola": { prefix: "+244", currency: "AOA" },
            "Benin": { prefix: "+229", currency: "XOF" },
            "Botswana": { prefix: "+267", currency: "BWP" },
            "Burkina Faso": { prefix: "+226", currency: "XOF" },
            "Burundi": { prefix: "+257", currency: "BIF" },
            "Cameroon": { prefix: "+237", currency: "XAF" },
            "Cape Verde": { prefix: "+238", currency: "CVE" },
            "Central African Republic": { prefix: "+236", currency: "XAF" },
            "Chad": { prefix: "+235", currency: "XAF" },
            "Comoros": { prefix: "+269", currency: "KMF" },
            "Congo": { prefix: "+242", currency: "XAF" },
            "Congo Democratic Republic": { prefix: "+243", currency: "CDF" },
            "Cote d'Ivoire": { prefix: "+225", currency: "XOF" },
            "Djibouti": { prefix: "+253", currency: "DJF" },
            "Egypt": { prefix: "+20", currency: "EGP" },
            "Equatorial Guinea": { prefix: "+240", currency: "XAF" },
            "Eritrea": { prefix: "+291", currency: "ERN" },
            "Eswatini": { prefix: "+268", currency: "SZL" },
            "Ethiopia": { prefix: "+251", currency: "ETB" },
            "France": { prefix: "+33", currency: "EUR" },
            "Gabon": { prefix: "+241", currency: "XAF" },
            "Gambia": { prefix: "+220", currency: "GMD" },
            "Germany": { prefix: "+49", currency: "EUR" },
            "Ghana": { prefix: "+233", currency: "GHS" },
            "Guinea": { prefix: "+224", currency: "GNF" },
            "Guinea-Bissau": { prefix: "+245", currency: "XOF" },
            "Italy": { prefix: "+39", currency: "EUR" },
            "Kenya": { prefix: "+254", currency: "KES" },
            "Lesotho": { prefix: "+266", currency: "LSL" },
            "Liberia": { prefix: "+231", currency: "LRD" },
            "Madagascar": { prefix: "+261", currency: "MGA" },
            "Malawi": { prefix: "+265", currency: "MWK" },
            "Mali": { prefix: "+223", currency: "XOF" },
            "Mauritania": { prefix: "+222", currency: "MRU" },
            "Mauritius": { prefix: "+230", currency: "MUR" },
            "Morocco": { prefix: "+212", currency: "MAD" },
            "Mozambique": { prefix: "+258", currency: "MZN" },
            "Namibia": { prefix: "+264", currency: "NAD" },
            "Niger": { prefix: "+227", currency: "XOF" },
            "Nigeria": { prefix: "+234", currency: "NGN" },
            "Rwanda": { prefix: "+250", currency: "RWF" },
            "Sao Tome and Principe": { prefix: "+239", currency: "STN" },
            "Senegal": { prefix: "+221", currency: "XOF" },
            "Seychelles": { prefix: "+248", currency: "SCR" },
            "Sierra Leone": { prefix: "+232", currency: "SLL" },
            "Somalia": { prefix: "+252", currency: "SOS" },
            "South Africa": { prefix: "+27", currency: "ZAR" },
            "South Sudan": { prefix: "+211", currency: "SSP" },
            "Spain": { prefix: "+34", currency: "EUR" },
            "Sudan": { prefix: "+249", currency: "SDG" },
            "Tanzania": { prefix: "+255", currency: "TZS" },
            "Togo": { prefix: "+228", currency: "XOF" },
            "Tunisia": { prefix: "+216", currency: "TND" },
            "Uganda": { prefix: "+256", currency: "UGX" },
            "United Kingdom": { prefix: "+44", currency: "GBP" },
            "United States": { prefix: "+1", currency: "USD" },
            "Zambia": { prefix: "+260", currency: "ZMW" },
            "Zimbabwe": { prefix: "+263", currency: "ZWD" }
        };

        // Function to update prefix based on country
        function updatePrefixFromCountry() {
            const country = $('#client_billing_country').val();
            if (countryMapping[country]) {
                const prefix = countryMapping[country].prefix;
                $('#country_prefix').text(prefix + " (" + countryMapping[country].currency + ")");
                $('#phone_prefix_select').val(prefix);
            } else {
                $('#country_prefix').text("?");
                $('#phone_prefix_select').val("");
            }
        }

        // Function to update country based on prefix
        function updateCountryFromPrefix() {
            const prefix = $('#phone_prefix_select').val();
            if (prefix) {
                // Mapping from prefix to country
                const prefixToCountry = {
                    '+225': 'Cote d\'Ivoire',
                    '+226': 'Burkina Faso',
                    '+223': 'Mali',
                    '+221': 'Senegal',
                    '+229': 'Benin',
                    '+228': 'Togo',
                    '+237': 'Cameroon',
                    '+227': 'Niger',
                    '+212': 'Morocco',
                    '+33': 'France',
                    '+1': 'United States',
                    '+44': 'United Kingdom',
                    '+49': 'Germany',
                    '+34': 'Spain',
                    '+39': 'Italy',
                    '+31': 'Netherlands',
                    '+41': 'Switzerland',
                    '+351': 'Portugal',
                    '+32': 'Belgium',
                    '+352': 'Luxembourg'
                };
                
                const country = prefixToCountry[prefix];
                if (country && countryMapping[country]) {
                    $('#client_billing_country').val(country);
                    // Rafraîchir le select2 pour afficher le pays
                    $('#client_billing_country').trigger('change.select2');
                    $('#country_prefix').text(prefix + " (" + countryMapping[country].currency + ")");
                }
            } else {
                $('#country_prefix').text("?");
            }
        }

        // Initialize on page load
        $(document).ready(function() {
            // Set initial values if client data exists
            setTimeout(function() {
                const selectedCountry = $('#client_billing_country').val();
                if (selectedCountry && countryMapping[selectedCountry]) {
                    const prefix = countryMapping[selectedCountry].prefix;
                    $('#phone_prefix_select').val(prefix);
                    $('#country_prefix').text(prefix + " (" + countryMapping[selectedCountry].currency + ")");
                }
                
                // Also check if prefix is already selected
                const selectedPrefix = $('#phone_prefix_select').val();
                if (selectedPrefix) {
                    updateCountryFromPrefix();
                }
            }, 100);
            
            // Event listeners
            $('#client_billing_country').on('change', function() {
                updatePrefixFromCountry();
            });
            
            $('#phone_prefix_select').on('change', function() {
                updateCountryFromPrefix();
            });
        });
    });
</script>
