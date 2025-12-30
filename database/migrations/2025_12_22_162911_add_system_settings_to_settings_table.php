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
            // System settings
            $table->string('settings_system_timezone')->default('UTC')->after('value');
            $table->string('settings_system_currency_code', 10)->default('USD')->after('settings_system_timezone');
            $table->string('settings_system_currency_symbol', 10)->default('$')->after('settings_system_currency_code');
            $table->string('settings_system_currency_position', 10)->default('left')->after('settings_system_currency_symbol');
        });
        
        // Update existing record with default values
        DB::table('settings')->update([
            'settings_system_timezone' => 'UTC',
            'settings_system_currency_code' => 'USD',
            'settings_system_currency_symbol' => '$',
            'settings_system_currency_position' => 'left'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'settings_system_timezone',
                'settings_system_currency_code',
                'settings_system_currency_symbol',
                'settings_system_currency_position'
            ]);
        });
    }
};
