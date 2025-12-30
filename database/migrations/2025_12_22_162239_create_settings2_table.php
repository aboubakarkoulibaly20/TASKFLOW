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
        Schema::create('settings2', function (Blueprint $table) {
            $table->bigIncrements('settings2_id');
            
            // Projects automation settings
            $table->string('settings2_projects_automation_default_status')->nullable();
            $table->boolean('settings2_projects_automation_create_invoices')->default(false);
            $table->boolean('settings2_projects_automation_convert_estimates_to_invoices')->default(false);
            $table->boolean('settings2_projects_automation_invoice_unbilled_hours')->default(false);
            $table->decimal('settings2_projects_automation_invoice_hourly_rate', 10, 2)->nullable();
            $table->bigInteger('settings2_projects_automation_invoice_hourly_tax_1')->nullable();
            $table->boolean('settings2_projects_automation_invoice_email_client')->default(false);
            
            // Proposals automation settings
            $table->string('settings2_proposals_automation_default_status')->nullable();
            $table->boolean('settings2_proposals_automation_create_project')->default(false);
            $table->string('settings2_proposals_automation_project_status')->nullable();
            $table->boolean('settings2_proposals_automation_project_email_client')->default(false);
            $table->boolean('settings2_proposals_automation_create_invoice')->default(false);
            $table->boolean('settings2_proposals_automation_invoice_email_client')->default(false);
            $table->integer('settings2_proposals_automation_invoice_due_date')->nullable();
            $table->boolean('settings2_proposals_automation_create_tasks')->default(false);
            
            $table->timestamp('settings2_created')->useCurrent();
            $table->timestamp('settings2_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings2');
    }
};
