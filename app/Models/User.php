<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @method create(array $array)
 * @method static where(array $array)
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'status',
        'registration_ip',
        'registration_date',
        'last_login_ip',
        'last_login_date',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
    ];

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function getStatusAttribute($value): string
    {
        return $value == 1 ? 'Активен' : 'Заблокирован';
    }
}
