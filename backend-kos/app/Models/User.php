<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Models\Organization;
use App\Models\Tenant;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'owner_id');
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function applications()
    {
        return $this->hasMany(OrganizationApplication::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'owner' && $this->role === 'owner' && $this->organization()->exists();
    }
}
