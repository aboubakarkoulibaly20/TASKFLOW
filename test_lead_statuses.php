<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\LeadStatus;

// Test the LeadStatus model
$lead_statuses = LeadStatus::orderBy('leadstatus_position', 'asc')->get();

if ($lead_statuses->count() > 0) {
    echo "LeadStatus model works!\n";
    echo "Found " . $lead_statuses->count() . " lead statuses:\n";
    
    foreach ($lead_statuses as $status) {
        echo "- " . $status->leadstatus_title . " (ID: " . $status->leadstatus_id . ", Color: " . $status->leadstatus_color . ")\n";
    }
} else {
    echo "No lead statuses found\n";
}
