<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$fields = DB::table('customfields')->where('customfields_type', 'clients')->get();
foreach ($fields as $field) {
    echo "ID: {$field->customfields_id} | Title: {$field->customfields_title} | Name: {$field->customfields_name} | Type: {$field->customfields_datatype}\n";
}
