<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Starting repair...\n";

    if (Schema::hasTable('roles')) {
         if (!Schema::hasColumn('roles', 'role_id')) {
            echo "Attempting to add role_id to roles...\n";
            DB::statement("ALTER TABLE roles ADD role_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
            echo "role_id added.\n";
        }
        foreach (['role_name' => "VARCHAR(100)", 'modules' => "TEXT", 'role_created' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP", 'role_updated' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"] as $col => $def) {
            if (!Schema::hasColumn('roles', $col)) {
                echo "Adding $col to roles...\n";
                DB::statement("ALTER TABLE roles ADD $col $def");
            }
        }
        
        if (DB::table('roles')->where('role_id', 1)->count() == 0) {
             echo "Creating Admin Role...\n";
             DB::table('roles')->insert(['role_id' => 1, 'role_name' => 'Administrator', 'guard_name' => 'web', 'modules' => '[]']);
        }
    }

    if (Schema::hasTable('users')) {
        foreach (['role_id' => "BIGINT UNSIGNED DEFAULT 0 AFTER id", 'created' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP", 'updated' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"] as $col => $def) {
             if (!Schema::hasColumn('users', $col)) {
                echo "Adding $col to users...\n";
                DB::statement("ALTER TABLE users ADD $col $def");
            }
        }
        
        echo "Attempting to create user admin@admin.com...\n";
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@admin.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'type' => 'team',
                'status' => 'active'
            ]
        );
        echo "User logic done.\n";
    }

    echo "Done.\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
