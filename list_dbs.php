<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$dbs = DB::select('SHOW DATABASES');
foreach($dbs as $db) {
    echo $db->Database . "\n";
}
