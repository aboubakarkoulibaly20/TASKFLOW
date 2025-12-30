<?php
include 'vendor/autoload.php';
$app = include 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$columnsToAdd = [
    'settings_system_timezone' => 'string',
    'settings_system_currency_code' => 'string(10)',
    'settings_system_currency_symbol' => 'string(10)',
    'settings_system_currency_position' => 'string(10)',
    'settings_system_javascript_versioning' => 'string(20)',
    'settings_theme_name' => 'string(50)',
    'settings_theme_color' => 'string(20)',
    'settings_theme_layout' => 'string(20)',
    'settings_theme_sidebar' => 'string(20)',
    'settings_theme_dark_mode' => 'boolean',
];

Schema::table('settings', function ($table) use ($columnsToAdd) {
    foreach ($columnsToAdd as $col => $type) {
        if (!Schema::hasColumn('settings', $col)) {
            echo "Adding column $col...\n";
            if ($type == 'boolean') {
                $table->boolean($col)->default(false);
            } elseif (strpos($type, 'string(') !== false) {
                $len = (int)filter_var($type, FILTER_SANITIZE_NUMBER_INT);
                $table->string($col, $len)->nullable();
            } else {
                $table->string($col)->nullable();
            }
        } else {
            echo "Column $col already exists.\n";
        }
    }
});

// Ensure record 1 exists
if (DB::table('settings')->where('settings_id', 1)->count() == 0) {
    echo "Creating initial settings record...\n";
    DB::table('settings')->insert([
        'settings_id' => 1,
        'settings_system_timezone' => 'UTC',
        'settings_system_javascript_versioning' => '1',
        'settings_theme_name' => 'default'
    ]);
} else {
    echo "Updating initial settings record defaults...\n";
    DB::table('settings')->where('settings_id', 1)->update([
        'settings_system_timezone' => 'UTC',
        'settings_system_javascript_versioning' => '1',
        'settings_theme_name' => 'default'
    ]);
}

echo "Done.\n";
