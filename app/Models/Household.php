<?php

namespace App\Models;

use App\Models\Inhabitant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $table = 'households';

    protected $fillable = [
        'id',
        'street',
        'brgy',
        'city',
        'isActive'
    ];

    public function Inhabitants()
    {
        return $this->hasMany(Inhabitant::class, 'householdId');
    }
}
