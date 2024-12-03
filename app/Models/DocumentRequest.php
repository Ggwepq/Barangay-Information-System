<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'document_type',
        'purpose',
        'requested_at',
        'approved_at',
        'expiration_date',
        'status',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
