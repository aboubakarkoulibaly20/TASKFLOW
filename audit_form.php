<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "--- CUSTOM FIELDS (clients) ---\n";
try {
    $fields = DB::select("SELECT * FROM customfields WHERE customfields_type = 'clients'");
    foreach ($fields as $field) {
        echo "Title: {$field->customfields_title} | Name: {$field->customfields_name} | Type: {$field->customfields_datatype}\n";
    }
} catch (\Exception $e) {
    echo "Error customfields: " . $e->getMessage() . "\n";
}

echo "\n--- CLIENTS TABLE COLUMNS ---\n";
try {
    $clientColumns = Schema::getColumnListing('clients');
    print_r($clientColumns);
} catch (\Exception $e) {
    echo "Error clients table: " . $e->getMessage() . "\n";
}

echo "\n--- USERS TABLE COLUMNS ---\n";
try {
    $userColumns = Schema::getColumnListing('users');
    print_r($userColumns);
} catch (\Exception $e) {
    echo "Error users table: " . $e->getMessage() . "\n";
}
