<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'description',
    ];

    /**
     * The scripts that belong to the character.
     */
    public function scripts(): BelongsToMany
    {
        return $this->belongsToMany(Script::class, 'script_character');
    }
}
