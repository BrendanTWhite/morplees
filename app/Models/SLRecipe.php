<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SLRecipe extends Model
{
    use HasFactory;

    /**
     * Get the shopping list that owns this record.
     */
    public function shopping_list()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    /**
     * Get the recipe that owns this record.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
