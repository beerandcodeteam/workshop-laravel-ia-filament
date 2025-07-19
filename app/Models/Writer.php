<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Writer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get all scripts written by this writer.
     */
    public function scripts(): HasMany
    {
        return $this->hasMany(Script::class);
    }
}
