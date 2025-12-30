<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$credentials = ['email' => 'admin@example.com', 'password' => 'password'];
if (Auth::attempt($credentials)) {
    echo "LOGIN_SUCCESS\n";
} else {
    echo "LOGIN_FAILED\n";
}

$credentials2 = ['email' => 'admin@admin.com', 'password' => 'password'];
if (Auth::attempt($credentials2)) {
    echo "LOGIN_SUCCESS_ADMIN_ADMIN\n";
} else {
    echo "LOGIN_FAILED_ADMIN_ADMIN\n";
}
