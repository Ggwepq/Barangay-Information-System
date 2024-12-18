<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'projectName',
        'projectDev',
        'description',
        'officerCharge',
        'dateStarted',
        'dateEnded',
        'status',
        'isActive'
    ];

    public function Resident()
    {
        return $this->belongsTo(Resident::class, 'projectDev');
    }

    public function Officer()
    {
        return $this->belongsTo(Officer::class, 'officerCharge');
    }
}
