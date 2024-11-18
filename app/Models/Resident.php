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
        'street',
        'brgy',
        'city',
        'citizenship',
        'religion',
        'dateCitizen',
        'orderApproval',
        'occupation',
        'tinNo',
        'isUnpleasant',
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
        return $this->hasMany(ParentModel::class, 'residentId');
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
