<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "--- DATABASE CHECK ---\n";
try {
    $users = DB::table('users')->get();
    echo "Total users: " . count($users) . "\n";
    foreach ($users as $u) {
        echo "ID: {$u->id} | Email: {$u->email} | Type: {$u->type} | Status: {$u->status} | Role: " . ($u->role_id ?? 'N/A') . "\n";
        echo "Password Hash: " . $u->password . "\n";
        echo "Password match 'password': " . (Hash::check('password', $u->password) ? 'YES' : 'NO') . "\n";
        echo "------------------\n";
    }
} catch (Exception $e) {
    echo "Error listing users: " . $e->getMessage() . "\n";
}

echo "\n--- AUTH ATTEMPT SIMULATION ---\n";
$credentials = ['email' => 'admin@example.com', 'password' => 'password'];
try {
    $success = Auth::attempt($credentials);
    echo "Auth::attempt with admin@example.com / password: " . ($success ? 'SUCCESS' : 'FAILED') . "\n";
    if ($success) {
        echo "Logged in as: " . Auth::user()->email . "\n";
    }
} catch (Exception $e) {
    echo "Error during Auth::attempt: " . $e->getMessage() . "\n";
}

echo "\n--- SCHEMA CHECK ---\n";
try {
    $columns = DB::select("DESCRIBE users");
    foreach ($columns as $col) {
        echo "Field: {$col->Field} | Type: {$col->Type} | Null: {$col->Null} | Key: {$col->Key}\n";
    }
} catch (Exception $e) {
    echo "Error describing users: " . $e->getMessage() . "\n";
}
