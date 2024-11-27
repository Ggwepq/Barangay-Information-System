<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentParent extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'residentId',
        'motherFirstName',
        'motherMiddleName',
        'motherLastName',
        'fatherFirstName',
        'fatherMiddleName',
        'fatherLastName',
        'isActive',
    ];
}
