<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFamily;

class SLItem extends Model
{
    use HasFactory;
    use BelongsToFamily;

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


    public function toggleAlreadyOwn() 
    {
        $this->already_own = ! $this->already_own;
        $this->save();
    }

    public function toggleInBasket() 
    {
        $this->in_basket = ! $this->in_basket;
        $this->save();
    }



    /**
     * Get the shopping list that owns this record.
     */
    public function shopping_list()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    /**
     * Get the product that owns this record.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the ingredient that owns this record.
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    /**
     * Get the SL Recipe that owns this record.
     */
    public function s_l_recipe()
    {
        return $this->belongsTo(SLRecipe::class);
    }

}
