<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conflict extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * The scripts that belong to the conflict.
     */
    public function scripts(): BelongsToMany
    {
        return $this->belongsToMany(Script::class, 'script_conflict');
    }
}
