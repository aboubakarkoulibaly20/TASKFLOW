<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$email = 'admin@admin.com';
$password = 'password';

$user = DB::table('users')->where('email', $email)->first();

if ($user) {
    echo "User found: " . $user->email . "\n";
    echo "Type: " . $user->type . "\n";
    echo "Status: " . $user->status . "\n";
    echo "Hash: " . $user->password . "\n";
    
    if (Hash::check($password, $user->password)) {
        echo "Password check: SUCCESS\n";
    } else {
        echo "Password check: FAILED\n";
    }
} else {
    echo "User NOT found: $email\n";
}
