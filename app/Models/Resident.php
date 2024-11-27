<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'residents';

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'province',
        'house_no',
        'street',
        'brgy',
        'city',
        'citizenship',
        'religion',
        'dateCitizen',
        'occupation',
        'gender',
        'birthdate',
        'birthPlace',
        'civilStatus',
        'periodResidence',
        'image',
        'isActive',
        'isRegistered',
        'isDerogatory',
        'contactNumber',
        'created_at'
    ];

    public function Parents()
    {
        return $this->hasMany(Parent::class, 'residentId');
    }

    public function Officer()
    {
        return $this->hasMany(Officer::class, 'officerId');
    }

    public function Voter()
    {
        return $this->hasMany(Voter::class, 'residentId');
    }
}
