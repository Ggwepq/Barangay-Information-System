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
        'age',
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
        return $this->hasMany(Officer::class, 'residentId', 'id');
    }

    public function Voter()
    {
        return $this->hasMany(Voter::class, 'residentId');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'residentId');
    }

    public function UserOfficer()
    {
        return $this->hasOne(User::class, 'officerId', 'id');
    }

    public function documentRequests()
    {
        return $this->hasMany(DocumentRequest::class);
    }

    public function Blotter()
    {
        return $this->hasMany(Blotter::class, 'complainedResident', 'id');
    }
}
