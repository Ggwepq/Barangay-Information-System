<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'residentId',
        'officerId',
        'date',
        'start',
        'end',
        'isActive'
    ];

    public function Resident()
    {
        return $this->belongsTo(Resident::class, 'residentId');
    }

    public function Officer()
    {
        return $this->belongsTo(Officer::class, 'officerId');
    }
}
