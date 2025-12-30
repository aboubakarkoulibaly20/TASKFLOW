<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;

    protected $table = 'situations';
    
    protected $fillable = [
        'client_id',
        'type_impot',
		'type_sociale',
        'regime',
        'montant',
        'periode',
        'date_paiement',
        'file',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    /**
     * Relation vers le client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
