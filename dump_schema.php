<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$columns = Schema::getColumnListing('settings');
file_put_contents('settings_columns.txt', implode("\n", $columns));

try {
    $c = DB::table('settings')->count();
    file_put_contents('settings_count.txt', $c);
} catch (Exception $e) {
    file_put_contents('settings_error.txt', $e->getMessage());
}
