<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Invoice;

class Contract extends Model
{
    protected $fillable = [
        'organization_id',
        'room_id',
        'tenant_id',
        'contract_number',
        'start_date',
        'end_date',
        'monthly_rent',
        'deposit',
        'payment_day',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'deposit' => 'decimal:2',
        'payment_day' => 'integer',
    ];

    public function organization()
    {
        return $this->belongsTo(
            Organization::class
        );
    }

    public function room()
    {
        return $this->belongsTo(
            Room::class
        );
    }

    public function tenant()
    {
        return $this->belongsTo(
            Tenant::class
        );
    }

    public function invoices()
    {
        return $this->hasMany(
            Invoice::class
        );
    }
}