<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method create(array $array)
 * @method where(array $array)
 */
class Menu extends Model
{
    protected $fillable = [
        'rate_id',
        'user_id',
        'name',
        'slug',
        'image',
        'status',
    ];

    public function getStatusAttribute($value): string
    {
        return $value == 1 ? 'Активен' : 'Заблокирован';
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
