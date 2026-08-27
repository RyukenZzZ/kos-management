<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Organization;
use App\Models\PropertyPhoto;
use App\Models\Room;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'description',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
    ];

    public function organization()
    {
        return $this->belongsTo(
            Organization::class
        );
    }

    public function photos()
    {
        return $this->hasMany(
            PropertyPhoto::class
        );
    }

    public function rooms()
    {
        return $this->hasMany(
            Room::class
        );
    }
}