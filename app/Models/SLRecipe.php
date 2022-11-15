<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFamily;
use App\Observers\SLRecipeObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Properties\TextProperty;

class SLRecipe extends Model
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
        'recipe_id',
        'date',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = [];

    
    protected $casts = [
        'date' => 'date',
    ];



    /**
     * Create Required SLItems for this SLRecipe.
     */
    public function createSLItems()
    {
        $this->recipe->ingredients->each(

            function(Models\Ingredient $ingredient) {
                $newSLItem = Models\SLItem::create([
                    'shopping_list_id' => $this->shopping_list_id,
                    'product_id' => $ingredient->product->id,
                    'ingredient_id' => $ingredient->id,
                    's_l_recipe_id' => $this->id,
                    'family_id'     => $this->family_id,
                ]);
            }

        );
    }


    protected static function booted()
    {
        static::creating(function ($SLRecipe) { 

            // add a uuid
            $SLRecipe->uuid = (string) Str::uuid();

            // If we don't already have a SL ID set, 
            // then get a sensible default
            if ( ! $SLRecipe->shopping_list_id ) {
               $SLRecipe->shopping_list_id = ShoppingList::getActiveSL()->id; 
            }

        });
    }


    /**
     * Delete All SLItems for this SLRecipe.
     */
    public function deleteSLItems()
    {
        $this->s_l_items->each(function(Models\SLItem $s_l_item) {
             $s_l_item->delete();
        });
    }

    public function getEvent() {
        return Event::create()
            ->uniqueIdentifier($this->uuid)
            ->startsAt($this->date)
            ->fullDay()
            ->name($this->recipe->name)            
            ->appendProperty(
                TextProperty::create('URL', 
                    route('filament.resources.recipes.view', ['record' => $this->recipe->id])
                )
            )
            ->description($this->recipe->products
                ->implode('name', ' / '));
    }


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
