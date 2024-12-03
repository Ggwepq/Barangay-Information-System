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
        'isPWD',
        'is4Ps',
        'isActive',
        'isRegistered',
        'isDerogatory',
        'contactNumber',
        'created_at'
    ];

    public function Parents()
    {
        return $this->hasMany(ResidentParent::class, 'residentId');
    }

    public function Officer()
    {
        return $this->hasMany(Officer::class);
    }

    public function Voter()
    {
        return $this->hasMany(Voter::class, 'residentId');
    }

    public function documentRequests()
    {
        return $this->hasMany(DocumentRequest::class);
    }
}
