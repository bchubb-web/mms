<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    public function fields(): HasMany
    {
        return $this->hasMany(PageField::class);
    }

    public function pageField(): HasMany
    {
        return $this->hasMany(PageField::class);
    }
}
