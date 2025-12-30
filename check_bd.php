<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

config(['database.connections.mysql.database' => 'taskflow_bd']);
DB::purge('mysql');
DB::reconnect('mysql');

echo "--- DATABASE: taskflow_bd ---\n";
try {
    $users = DB::table('users')->get();
    echo "Total users: " . count($users) . "\n";
    foreach ($users as $u) {
        echo "ID: {$u->id} | Email: {$u->email} | Type: {$u->type} | Status: {$u->status}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
