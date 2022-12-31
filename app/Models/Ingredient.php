<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Ingredient extends Model
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
        'product_id',
        'sequence',
        'quantity',
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

        // If we're trying to create an empty ingredient with no quanitity and no product,
        // then don't create it.
        static::creating(function ($ingredient) {
            if ( !$ingredient->quantity && !$ingredient->product_id ) {
                return false;
            }
        });

        // If we're trying to update an ingredient to be empty with no quanitity and no product,
        // then delete it (and don't update it).
        static::updating(function ($ingredient) {
            if ( !$ingredient->quantity && !$ingredient->product_id ) {
                $ingredient->delete();
                return false;
            }
        });

    }

    /**
     * Get the recipe that owns the ingredient.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Get the product that owns the ingredient.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the SL Items for this record.
     */
    public function s_l_items() // snake for Filament
    {
        return $this->hasMany(SLItem::class);
    }

    /**
     * Get the SL Items for this record.
     */
    public function sLItems() // Camel for seeder
    {
        return $this->hasMany(SLItem::class);
    }
}
