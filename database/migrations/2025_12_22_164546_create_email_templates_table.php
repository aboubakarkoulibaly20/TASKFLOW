<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->bigIncrements('emailtemplate_id');
            $table->string('emailtemplate_name', 100)->unique(); // Template name
            $table->string('emailtemplate_subject', 255); // Email subject
            $table->text('emailtemplate_body'); // Email body content
            $table->string('emailtemplate_type', 50)->default('system'); // 'system' or 'custom'
            $table->text('emailtemplate_description')->nullable(); // Optional description
            $table->boolean('emailtemplate_status')->default(true); // Active/inactive
            $table->bigInteger('emailtemplate_creatorid')->unsigned()->nullable(); // Creator user ID
            $table->timestamp('emailtemplate_created')->useCurrent();
            $table->timestamp('emailtemplate_updated')->useCurrent()->useCurrentOnUpdate();
            
            // Foreign key constraint
            $table->foreign('emailtemplate_creatorid')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
