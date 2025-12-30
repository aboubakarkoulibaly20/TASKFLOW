<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$files = glob('database/migrations/*.php');
sort($files);

foreach ($files as $file) {
    $migrationName = basename($file, '.php');
    echo "Processing $migrationName...\n";
    
    // Check if already in migrations table
    if (DB::table('migrations')->where('migration', $migrationName)->exists()) {
        echo "Already migrated. Skipping.\n";
        continue;
    }

    try {
        Artisan::call('migrate', ['--path' => $file, '--force' => true]);
        echo Artisan::output();
    } catch (Throwable $e) {
        if (str_contains($e->getMessage(), 'already exists')) {
            echo "Table already exists. Marking as migrated in DB.\n";
            DB::table('migrations')->insert([
                'migration' => $migrationName,
                'batch' => 1
            ]);
        } else {
            echo "Error in $migrationName: " . $e->getMessage() . "\n";
        }
    }
}
