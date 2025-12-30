<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Starting repair v3...\n";

    if (Schema::hasTable('roles')) {
        if (Schema::hasColumn('roles', 'id') && !Schema::hasColumn('roles', 'role_id')) {
            echo "Renaming id to role_id in roles table...\n";
            DB::statement("ALTER TABLE roles CHANGE id role_id BIGINT UNSIGNED AUTO_INCREMENT");
            echo "Renamed.\n";
        } elseif (!Schema::hasColumn('roles', 'role_id')) {
            echo "Adding role_id to roles table...\n";
            DB::statement("ALTER TABLE roles ADD role_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY FIRST");
            echo "Added.\n";
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
        foreach (['role_id' => "BIGINT UNSIGNED DEFAULT 1 AFTER id", 'created' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP", 'updated' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"] as $col => $def) {
             if (!Schema::hasColumn('users', $col)) {
                echo "Adding $col to users...\n";
                DB::statement("ALTER TABLE users ADD $col $def");
            }
        }
        
        echo "Creating/Updating admin user...\n";
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
