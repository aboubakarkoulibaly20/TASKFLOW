<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Repairing roles table...\n";
if (Schema::hasTable('roles')) {
    Schema::table('roles', function ($table) {
        if (!Schema::hasColumn('roles', 'role_id')) {
            echo "Adding role_id to roles...\n";
            // If 'id' exists from Spatie, we keep it but add 'role_id'
            $table->bigIncrements('role_id')->first();
        }
        if (!Schema::hasColumn('roles', 'role_name')) {
            echo "Adding role_name to roles...\n";
            $table->string('role_name', 100)->nullable();
        }
        if (!Schema::hasColumn('roles', 'modules')) {
            echo "Adding modules to roles...\n";
            $table->text('modules')->nullable();
        }
        if (!Schema::hasColumn('roles', 'role_created')) {
            echo "Adding role_created to roles...\n";
            $table->timestamp('role_created')->useCurrent();
        }
        if (!Schema::hasColumn('roles', 'role_updated')) {
            echo "Adding role_updated to roles...\n";
            $table->timestamp('role_updated')->useCurrent()->useCurrentOnUpdate();
        }
    });

    // Ensure role 1 exists
    if (DB::table('roles')->where('role_id', 1)->count() == 0) {
        echo "Creating Administrator role...\n";
        DB::table('roles')->insert([
            'role_id' => 1,
            'role_name' => 'Administrator',
            'guard_name' => 'web',
            'modules' => json_encode([]), // Full access usually handled elsewhere or populated later
        ]);
    }
}

echo "Repairing users table...\n";
if (Schema::hasTable('users')) {
    Schema::table('users', function ($table) {
        if (!Schema::hasColumn('users', 'role_id')) {
            echo "Adding role_id to users...\n";
            $table->unsignedBigInteger('role_id')->default(0)->after('id');
        }
        if (!Schema::hasColumn('users', 'created')) {
             if (!Schema::hasColumn('users', 'created_at')) {
                $table->timestamp('created')->useCurrent();
             } else {
                 // The model expects 'created' but DB might have 'created_at'
                 // Let's add 'created' as a copy or alias if needed
                 $table->timestamp('created')->useCurrent();
             }
        }
        if (!Schema::hasColumn('users', 'updated')) {
            $table->timestamp('updated')->useCurrent()->useCurrentOnUpdate();
        }
    });

    // Create Admin User
    $email = 'admin@admin.com';
    if (DB::table('users')->where('email', $email)->count() == 0) {
        echo "Creating Admin User...\n";
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => $email,
            'password' => Hash::make('password'),
            'role_id' => 1,
            'type' => 'team',
            'status' => 'active',
        ]);
        echo "Admin User created: $email / password\n";
    }
}

echo "Done.\n";
