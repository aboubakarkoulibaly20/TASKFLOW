<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

echo "Checking users for authentication...\n\n";

// Get all users
$users = DB::table('users')->get();

if ($users->count() == 0) {
    echo "No users found in database!\n";
    echo "You need to create at least one user.\n";
} else {
    echo "Found " . $users->count() . " users:\n\n";
    
    foreach ($users as $user) {
        echo "User ID: " . $user->id . "\n";
        echo "Email: " . $user->email . "\n";
        echo "Name: " . $user->prenom . " " . $user->nom . "\n";
        echo "Type: '" . $user->type . "'\n";
        echo "Status: '" . $user->status . "'\n";
        echo "Password Hash: " . substr($user->password, 0, 20) . "...\n";
        echo "---\n";
    }
    
    echo "\nAuthentication requirements:\n";
    echo "- User must exist with the provided email\n";
    echo "- User type must be 'team' or 'client'\n";
    echo "- User status must be 'active'\n";
    echo "- Password must match the stored hash\n";
    
    // Check if there's a default admin user
    $admin_user = DB::table('users')->where('email', 'admin@example.com')->first();
    if (!$admin_user) {
        echo "\nNo admin user found. Creating default admin user...\n";
        
        $default_password = 'password'; // Change this in production!
        DB::table('users')->insert([
            'nom' => 'Admin',
            'prenom' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make($default_password),
            'type' => 'team',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        echo "Created admin user:\n";
        echo "Email: admin@example.com\n";
        echo "Password: " . $default_password . "\n";
        echo "Please change this password after first login!\n";
    }
}
