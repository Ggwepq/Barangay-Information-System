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
        return $this->belongsTo('App\Resident', 'residentId');
    }

    public function Officer()
    {
        return $this->belongsTo('App\Officer', 'officerId');
    }
}
