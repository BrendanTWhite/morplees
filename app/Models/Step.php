<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFamily;

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
     * Get the recipe that owns the step.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
