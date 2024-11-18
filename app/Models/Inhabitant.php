<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inhabitant extends Model
{
    use HasFactory;

    protected $table = 'inhabitants';

    protected $fillable = [
        'residentId',
        'householdId',
        'isActive'
    ];

    public function Resident()
    {
        return $this->belongsTo(Resident::class, 'residentId');
    }
}
