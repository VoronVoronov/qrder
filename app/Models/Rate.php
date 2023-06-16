<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
