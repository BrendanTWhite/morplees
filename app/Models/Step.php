<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    use BelongsToFamily;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'recipe_id',
        'sequence',
        'instructions',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {

        // If we're trying to create a empty step with no instructions,
        // then don't create it.
        static::creating(function ($step) {
            if ( !$step->instructions ) {
                return false;
            }
        });

        // If we're trying to update a step to be empty with no instructions,
        // then delete it (and don't update it).
        static::updating(function ($step) {
            if ( !$step->instructions ) {
                $step->delete();
                return false;
            }
        });

    }

    /**
     * Get the recipe that owns the step.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
