<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$columns = Schema::getColumnListing('roles');
echo "Columns in roles table:\n";
print_r($columns);

$rolesCount = DB::table('roles')->count();
echo "Roles count: $rolesCount\n";
