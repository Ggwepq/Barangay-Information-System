<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    protected $fillable = [
        'residentId',
        'positionId',
        'isActive'
    ];

    public function Resident()
    {
        return $this->belongsTo(Resident::class, 'residentId');
    }

    public function Position()
    {
        return $this->belongsTo(Position::class, 'positionId');
    }

    public function User()
    {
        return $this->hasMany(User::class, 'officerId', 'id');
    }
}
