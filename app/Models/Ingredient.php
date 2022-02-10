<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFamily;

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
