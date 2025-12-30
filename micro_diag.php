<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
echo "DB_ACTIVE:" . DB::connection()->getDatabaseName() . "\n";
$u = \App\Models\User::where('email', 'admin@example.com')->first();
if($u) {
    echo "USER_FOUND\n";
} else {
    echo "USER_NOT_FOUND\n";
}
