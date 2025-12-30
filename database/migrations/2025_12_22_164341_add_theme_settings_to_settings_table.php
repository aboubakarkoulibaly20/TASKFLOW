<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Theme settings
            $table->string('settings_theme_name', 50)->default('default')->after('settings_system_currency_position');
            $table->string('settings_theme_color', 20)->default('blue')->after('settings_theme_name');
            $table->string('settings_theme_layout', 20)->default('horizontal')->after('settings_theme_color');
            $table->string('settings_theme_sidebar', 20)->default('expanded')->after('settings_theme_layout');
            $table->boolean('settings_theme_dark_mode')->default(false)->after('settings_theme_sidebar');
        });
        
        // Update existing record with default values
        DB::table('settings')->update([
            'settings_theme_name' => 'default',
            'settings_theme_color' => 'blue',
            'settings_theme_layout' => 'horizontal',
            'settings_theme_sidebar' => 'expanded',
            'settings_theme_dark_mode' => false
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'settings_theme_name',
                'settings_theme_color',
                'settings_theme_layout',
                'settings_theme_sidebar',
                'settings_theme_dark_mode'
            ]);
        });
    }
};
