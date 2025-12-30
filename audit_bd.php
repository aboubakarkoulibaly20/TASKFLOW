<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "DB:" . DB::connection()->getDatabaseName() . "\n";

$tables = array_map('reset', DB::select('SHOW TABLES'));
echo "Tables: " . implode(', ', $tables) . "\n";

if (Schema::hasTable('roles')) {
    echo "Roles table EXISTS\n";
    $cols = array_map(function($c) { return $c->Field; }, DB::select("DESCRIBE roles"));
    echo "Roles cols: " . implode(', ', $cols) . "\n";
} else {
    echo "Roles table MISSING\n";
}

if (Schema::hasColumn('users', 'role_id')) {
    echo "Users has role_id: YES\n";
} else {
    echo "Users has role_id: NO\n";
}

$u = \App\Models\User::where('email', 'admin@example.com')->first();
if($u) {
    echo "Admin user: FOUND\n";
    echo "Admin role_id: " . ($u->role_id ?? 'NULL') . "\n";
} else {
    echo "Admin user: NOT FOUND\n";
}
