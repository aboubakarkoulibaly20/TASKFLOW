<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

config(['database.connections.mysql.database' => 'taskflow_bd']);
DB::purge('mysql');
DB::reconnect('mysql');

echo "--- SCHEMA: taskflow_bd ---\n";
try {
    $columns = DB::select("DESCRIBE users");
    foreach ($columns as $col) {
        echo "Field: {$col->Field} | Type: {$col->Type}\n";
    }
    
    echo "\n--- ROLES TABLE ---\n";
    $roles = DB::select("SHOW TABLES LIKE 'roles'");
    if($roles) {
        $cols = DB::select("DESCRIBE roles");
        foreach ($cols as $c) {
            echo "Field: {$c->Field} | Type: {$c->Type}\n";
        }
    } else {
        echo "Roles table MISSING\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
