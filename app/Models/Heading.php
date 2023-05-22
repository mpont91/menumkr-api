<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Heading extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'menu_id',
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
