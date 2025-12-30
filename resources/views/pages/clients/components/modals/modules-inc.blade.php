<!--(select2-preselected) &  (data-preselected) are optional-->
<div class="form-group row">
    <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label">@lang('lang.enabled_modules')</label>
    <div class="col-sm-12 col-lg-9">
        <select class="select2-basic form-control form-control-sm select2-preselected"
            id="client_app_modules" name="client_app_modules"
            data-preselected="{{ $client->client_app_modules ?? 'system' }}">
            <option value="system">@lang('lang.use_system_settings')</option>
            <option value="custom">@lang('lang.use_custom_settings')</option>
        </select>
    </div>
</div>


<!--custom client modules settings-->
<div id="client_app_modules_pemissions"
    class="{{ runtimeVisibility('client_app_modules_pemissions', $client->client_app_modules ?? 'system') }}">

    <div class="highlighted-panel">
        <!--preselect when in create mode-->
        @php $creation_prechecked = ($page['section'] == 'create') ? 'checked' : ''; @endphp

        <!--_projects-->
        @if(config('system.settings_modules_projects') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.projects')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_projects"
                    name="client_settings_modules_projects"
                    {{ runtimePrechecked($client->client_settings_modules_projects ?? '') }} {{  $creation_prechecked }} class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_projects"></label>
            </div>
        </div>
        @endif


        <!--invoices-->
        @if(config('system.settings_modules_invoices') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.invoices')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_invoices"
                    name="client_settings_modules_invoices"
                    {{ runtimePrechecked($client->client_settings_modules_invoices ?? '') }} {{  $creation_prechecked }}  class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_invoices"></label>
            </div>
        </div>
        @endif


        <!--payments-->
        @if(config('system.settings_modules_payments') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.payments')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_payments"
                    name="client_settings_modules_payments"
                    {{ runtimePrechecked($client->client_settings_modules_payments ?? '') }} {{  $creation_prechecked }}  class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_payments"></label>
            </div>
        </div>
        @endif


        <!--knowledgebase-->
        @if(config('system.settings_modules_knowledgebase') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.knowledgebase')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_knowledgebase"
                    name="client_settings_modules_knowledgebase"
                    {{ runtimePrechecked($client->client_settings_modules_knowledgebase ?? '') }} {{  $creation_prechecked }}  class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_knowledgebase"></label>
            </div>
        </div>
        @endif


        <!--estimates-->
        @if(config('system.settings_modules_estimates') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.estimates')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_estimates"
                    name="client_settings_modules_estimates"
                    {{ runtimePrechecked($client->client_settings_modules_estimates ?? '') }} {{  $creation_prechecked }}  class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_estimates"></label>
            </div>
        </div>
        @endif


        <!--subscriptions-->
        @if(config('system.settings_modules_subscriptions') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.subscriptions')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_subscriptions"
                    name="client_settings_modules_subscriptions"
                    {{ runtimePrechecked($client->client_settings_modules_subscriptions ?? '') }} {{  $creation_prechecked }}  class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_subscriptions"></label>
            </div>
        </div>
        @endif


        <!--tickets-->
        @if(config('system.settings_modules_tickets') == 'enabled')
        <div class="form-group form-group-checkbox row">
            <label class="col-sm-12 col-lg-10 col-form-label text-left">@lang('lang.tickets')</label>
            <div class="col-sm-12 col-lg-2 text-left p-t-5">
                <input type="checkbox" id="client_settings_modules_tickets"
                    name="client_settings_modules_tickets"
                    {{ runtimePrechecked($client->client_settings_modules_tickets ?? '') }} {{  $creation_prechecked }}  class="filled-in chk-col-light-blue">
                <label for="client_settings_modules_tickets"></label>
            </div>
        </div>
        @endif

        <div class="alert alert-info">@lang('lang.only_system_enabled_modules_enabled') <a href="{{ url('app/settings/modules') }}" target="_blank">(@lang('lang.see_settings'))</a></div>
    </div>

</div>
