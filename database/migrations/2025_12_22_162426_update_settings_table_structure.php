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
            // Add settings_id column as a regular column
            $table->bigInteger('settings_id')->unsigned()->after('id');
            
            // Add timestamp columns with proper names
            $table->timestamp('settings_created')->useCurrent()->after('updated_at');
            $table->timestamp('settings_updated')->useCurrent()->useCurrentOnUpdate()->after('settings_created');
        });
        
        // Update existing record to have settings_id = 1
        DB::table('settings')->update(['settings_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['settings_id', 'settings_created', 'settings_updated']);
        });
    }
};
