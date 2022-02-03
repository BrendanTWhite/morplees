<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\JustMyFamilyScope;

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
        'itemable_type',
        'itemable_id',
        'needed',
        'bought',
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
    public function itemable()
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


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new JustMyFamilyScope);
    }

}
