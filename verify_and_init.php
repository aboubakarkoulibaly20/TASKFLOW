<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$tables = [
    'currencies' => Schema::hasTable('currencies'),
    'settings' => Schema::hasTable('settings'),
];

print_r($tables);

if ($tables['settings']) {
    echo "Check settings record...\n";
    $settings = DB::table('settings')->where('settings_id', 1)->first();
    if (!$settings) {
        echo "Creating settings record 1...\n";
        DB::table('settings')->insert([
            'settings_id' => 1,
            'settings_system_timezone' => 'UTC',
            'settings_system_currency_code' => 'USD',
            'settings_system_currency_symbol' => '$',
            'settings_system_currency_position' => 'left'
        ]);
        echo "Created.\n";
    } else {
        echo "Settings record 1 already exists.\n";
        if (!isset($settings->settings_system_timezone)) {
            echo "Column settings_system_timezone missing? Check schema.\n";
            $columns = Schema::getColumnListing('settings');
            print_r($columns);
        }
    }
}
