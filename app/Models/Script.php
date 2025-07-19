<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Script extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'writer_id',
        'year',
        'file_path',
        'one_liner',
        'short_synopsis',
        'era',
        'suggested_style',
        'expected_impact',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    /**
     * Get the writer of this script.
     */
    public function writer(): BelongsTo
    {
        return $this->belongsTo(Writer::class);
    }

    /**
     * The genres that belong to the script.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'script_genre');
    }

    /**
     * The conflicts that belong to the script.
     */
    public function conflicts(): BelongsToMany
    {
        return $this->belongsToMany(Conflict::class, 'script_conflict');
    }

    /**
     * The themes that belong to the script.
     */
    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, 'script_theme');
    }

    /**
     * The environments that belong to the script.
     */
    public function environments(): BelongsToMany
    {
        return $this->belongsToMany(Environment::class, 'script_environment');
    }

    /**
     * The color palettes that belong to the script.
     */
    public function colorPalettes(): BelongsToMany
    {
        return $this->belongsToMany(ColorPalette::class, 'script_color_palette');
    }

    /**
     * The narrative paces that belong to the script.
     */
    public function narrativePaces(): BelongsToMany
    {
        return $this->belongsToMany(NarrativePace::class, 'script_narrative_pace');
    }

    /**
     * The visual elements that belong to the script.
     */
    public function visualElements(): BelongsToMany
    {
        return $this->belongsToMany(VisualElement::class, 'script_visual_element');
    }

    /**
     * The emotional curves that belong to the script.
     */
    public function emotionalCurves(): BelongsToMany
    {
        return $this->belongsToMany(EmotionalCurve::class, 'script_emotional_curve');
    }

    /**
     * The characters that belong to the script.
     */
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'script_character');
    }
}
