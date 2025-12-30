<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$files = glob('database/migrations/*.php');
sort($files);

foreach ($files as $file) {
    echo "Processing $file...\n";
    try {
        Artisan::call('migrate', ['--path' => $file, '--force' => true]);
        echo Artisan::output();
    } catch (Throwable $e) {
        echo "Error in $file: " . (string)$e . "\n";
    }
}
