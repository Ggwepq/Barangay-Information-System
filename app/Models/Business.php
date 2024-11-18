<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'businesses';

    protected $fillable = [
        'residentId',
        'name',
        'street',
        'brgy',
        'city',
        'description',
        'isActive',
        'created_at'
    ];

    public function Resident()
    {
        return $this->belongsTo('App\Resident', 'residentId');
    }
}
