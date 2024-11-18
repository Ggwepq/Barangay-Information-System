<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;

    protected $table = 'blotters';

    protected $fillable = [
        'id',
        'complainant',
        'complainedResident',
        'officerCharge',
        'description',
        'status',
        'isActive',
        'created_at'
    ];

    public function comRes()
    {
        return $this->belongsTo(Resident::class, 'complainedResident');
    }

    public function com()
    {
        return $this->belongsTo(Resident::class, 'complainant');
    }
}
