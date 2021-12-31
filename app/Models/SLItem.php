<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SLItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shopping_list_id',
        'product_id',
        'ingredient_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'need_to_buy' => 'boolean',
    ];


    /**
     * Get the shopping list that owns this record.
     */
    public function shopping_list()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    /**
     * Get the model (either Ingredient or Product) for this SLItem.
     */
    public function itemable(): Model
    {
        return $this->morphTo();
    }

    /**
     * Get the Ingredient (if there is one) for this SLItem.
     */
    public function ingredient(): ?Model\Ingredient
    {
        $itemable = $this->itemable;
        if($itemable instanceof Model\Ingredient) {
            return $itemable;
        } else {
            return null;
        }
    }

    /**
     * Get the Recipe (if there is one) for this SLItem.
     */
    public function recipe(): ?Model\Recipe
    {
        $itemable = $this->itemable;
        if($itemable instanceof Model\Ingredient) {
            return $itemable->recipe;
        } else {
            return null;
        }
    }

    /**
     * Get the Product (either directly or via an Ingredient) for this SLItem.
     */
    public function product(): Model\Product
    {
        $itemable = $this->itemable;
        if($itemable instanceof Model\Ingredient) {
            return $itemable->product;
        } else {
            return $itemable;
        }        
    }

}
