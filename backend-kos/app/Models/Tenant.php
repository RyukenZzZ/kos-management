<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Organization;
use App\Models\User;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'name',
        'email',
        'phone',
        'identity_number',
        'identity_photo',
        'photo',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    public function organization()
    {
        return $this->belongsTo(
            Organization::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function contracts()
    {
        return $this->hasMany(
            Contract::class
        );
    }
    
}