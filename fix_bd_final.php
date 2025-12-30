<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Running fix on " . DB::connection()->getDatabaseName() . "\n";

// 1. Fix roles table
if (!Schema::hasTable('roles')) {
    echo "Creating roles table...\n";
    Schema::create('roles', function ($table) {
        $table->bigIncrements('role_id');
        $table->string('role_name');
        $table->text('modules')->nullable();
        $table->timestamp('role_created')->nullable();
        $table->timestamp('role_updated')->nullable();
    });
} else {
    // Check if it has 'id' instead of 'role_id'
    if (Schema::hasColumn('roles', 'id') && !Schema::hasColumn('roles', 'role_id')) {
        echo "Renaming roles.id to role_id...\n";
        DB::statement("ALTER TABLE roles CHANGE id role_id BIGINT UNSIGNED AUTO_INCREMENT");
    }
    // Check for other expected columns
    if (!Schema::hasColumn('roles', 'role_name')) {
        DB::statement("ALTER TABLE roles ADD role_name VARCHAR(255) AFTER role_id");
    }
}

// 2. Ensure Admin Role
$adminRole = DB::table('roles')->where('role_id', 1)->first();
if (!$adminRole) {
    echo "Inserting Administrator role...\n";
    DB::table('roles')->insert([
        'role_id' => 1,
        'role_name' => 'Administrator',
        'role_created' => now(),
        'role_updated' => now(),
    ]);
}

// 3. Fix users table
if (!Schema::hasColumn('users', 'role_id')) {
    echo "Adding role_id to users...\n";
    Schema::table('users', function ($table) {
        $table->unsignedBigInteger('role_id')->default(1)->after('id');
    });
}

// 4. Ensure Admin User
$adminEmail = 'admin@example.com';
$adminUser = DB::table('users')->where('email', $adminEmail)->first();
if (!$adminUser) {
    echo "Creating admin@example.com...\n";
    DB::table('users')->insert([
        'email' => $adminEmail,
        'first_name' => 'Admin',
        'last_name' => 'User',
        'password' => Hash::make('password'),
        'role_id' => 1,
        'type' => 'team',
        'status' => 'active',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
} else {
    echo "Updating admin@example.com password and status...\n";
    DB::table('users')->where('email', $adminEmail)->update([
        'password' => Hash::make('password'),
        'role_id' => 1,
        'type' => 'team',
        'status' => 'active'
    ]);
}

echo "FIX COMPLETED\n";
