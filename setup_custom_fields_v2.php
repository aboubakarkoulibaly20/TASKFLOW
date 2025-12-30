<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$mapping = [
    'client_custom_field_1' => ['title' => 'Genre', 'type' => 'dropdown'],
    'client_custom_field_2' => ['title' => 'Salutation', 'type' => 'dropdown'],
    'client_custom_field_3' => ['title' => 'Forme Juridique', 'type' => 'dropdown'],
    'client_custom_field_4' => ['title' => 'RCCM', 'type' => 'text'],
    'client_custom_field_5' => ['title' => 'IDU', 'type' => 'text'],
    'client_custom_field_6' => ['title' => 'Fiscalité', 'type' => 'text'],
    'client_custom_field_7' => ['title' => 'Branche', 'type' => 'text'],
    'client_custom_field_8' => ['title' => 'Quartier', 'type' => 'text'],
    'client_custom_field_9' => ['title' => 'Nom commercial', 'type' => 'text'],
    'client_custom_field_10' => ['title' => 'Nom du Dirigeant', 'type' => 'text'],
    'client_custom_field_12' => ['title' => 'Connexion autorisée', 'type' => 'text'],
    'client_custom_field_13' => ['title' => 'Notifications par e-mail', 'type' => 'text'],
];

foreach ($mapping as $name => $data) {
    DB::table('customfields')
        ->where('customfields_name', $name)
        ->where('customfields_type', 'clients')
        ->update([
            'customfields_title' => $data['title'],
            'customfields_datatype' => $data['type'],
            'customfields_status' => 'enabled',
            'customfields_standard_form_status' => 'enabled',
            'customfields_show_filter_panel' => 'yes',
            'customfields_show_all_tables' => 'yes',
        ]);
    echo "Updated: $name to {$data['title']}\n";
}
