<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    protected  $casts = [
        'role' => Role::class,
    ];

    public function order(): HasMany {
        return $this->hasMany(Order::class);
    }

    public function favorites(): HasOne {
        return $this->hasOne(Favorite::class);
    }
}
