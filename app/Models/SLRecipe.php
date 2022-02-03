<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\JustMyFamilyScope;

class SLRecipe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shopping_list_id',
        'recipe_id',
    ];

    


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
