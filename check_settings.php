<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$columns = Schema::getColumnListing('settings');
echo "Columns in settings table:\n";
print_r($columns);

$settingsCount = DB::table('settings')->count();
echo "Settings count: $settingsCount\n";

if ($settingsCount == 0) {
    echo "Attempting to insert initial row...\n";
    $data = [
        'variable' => 'system_settings',
        'value' => 'initial'
    ];
    if (in_array('settings_id', $columns)) $data['settings_id'] = 1;
    if (in_array('settings_system_timezone', $columns)) $data['settings_system_timezone'] = 'UTC';
    
    try {
        DB::table('settings')->insert($data);
        echo "Insert successful.\n";
    } catch (Exception $e) {
        echo "Insert failed: " . $e->getMessage() . "\n";
    }
} else {
    echo "Settings row already exists.\n";
}
