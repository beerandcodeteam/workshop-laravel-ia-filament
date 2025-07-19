<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VisualElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * The scripts that belong to the visual element.
     */
    public function scripts(): BelongsToMany
    {
        return $this->belongsToMany(Script::class, 'script_visual_element');
    }
}
