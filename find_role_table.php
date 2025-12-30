<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$tables = DB::select('SHOW TABLES');
foreach ($tables as $table) {
    $tableName = current((array)$table);
    $columns = Schema::getColumnListing($tableName);
    if (in_array('role_id', $columns) || in_array('role_name', $columns)) {
        echo "Table Found: $tableName\n";
        print_r($columns);
    }
}
