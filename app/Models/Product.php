<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use BelongsToFamily;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'shop_id',
        'family_id',
        'default_in_list',
        'needed_soon',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = [];

    public function toggleDefaultInList()
    {
        $this->default_in_list = ! $this->default_in_list;
        $this->save();
    }

    public function toggleNeededSoon()
    {
        $this->needed_soon = ! $this->needed_soon;
        $this->save();
    }

    /**
     * Get the name of the shop that owns the product.
     */
    public function getShopNameAttribute(): ?string
    {
        return 
            ($this->shop_id)
            ? $this->shop->name
            : '';
        }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {

        // If we're trying to delete a product that is  
        // being used as an ingredient in a recipe,
        // or has been used in a shopping list,
        // then warn the user and don't delete it.
        static::deleting(function ($product) {

            if ( ! $product->s_l_items->isEmpty() ) {
                Notification::make() 
                    ->title("Can't delete '$product->name' as it's been used on a shopping list.")
                    ->warning()
                    ->persistent()
                    ->send(); 

                return false;
            }

            if ( ! $product->ingredients->isEmpty() ) {
                Notification::make() 
                    ->title("Can't delete '$product->name' as it's being used in a recipe.")
                    ->warning()
                    ->persistent()
                    ->send(); 

                return false;
            }

        });

    }

    /**
     * Get the shop that owns the product.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the ingredients for the product.
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
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

    /**
     * The recipes that belong to the product.
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredients');
    }
}
