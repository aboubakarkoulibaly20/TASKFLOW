<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\Schema;
$columns = Schema::getColumnListing('clients');
file_put_contents('clients_columns.txt', implode("\n", $columns));
echo "Done";
