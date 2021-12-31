<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

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
     * Get all of the ingredient's SL items.
     */
    public function s_l_items()
    {
        return $this->morphMany('App\Models\SLItem', 'itemable');
    }

}
