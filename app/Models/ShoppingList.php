<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;


    /**
     * Get the family that owns the shopping list.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

}
