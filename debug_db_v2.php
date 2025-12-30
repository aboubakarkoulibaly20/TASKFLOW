<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "TABLES:\n";
$tables = DB::select('SHOW TABLES');
foreach ($tables as $table) {
    echo "- " . current((array)$table) . "\n";
}

echo "\nUSERS COLUMNS:\n";
print_r(Schema::getColumnListing('users'));

echo "\nROLES COLUMNS:\n";
print_r(Schema::getColumnListing('roles'));

echo "\nROLES DATA:\n";
print_r(DB::table('roles')->get()->toArray());

echo "\nUSERS DATA:\n";
print_r(DB::table('users')->get()->toArray());
