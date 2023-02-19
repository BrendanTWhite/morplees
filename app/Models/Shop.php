<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
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
        'family_id',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = [
        'name',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {

        // If we're trying to delete a shop that is  
        // being used for a product,
        // then warn the user and don't delete it.
        static::deleting(function ($shop) {

            if ( ! $shop->products->isEmpty() ) {
                Notification::make() 
                    ->title("Can't delete '$shop->name' as it's been used for a product.")
                    ->warning()
                    ->persistent()
                    ->send(); 

                return false;
            }

        });

    }

    /**
     * Get the family that owns the shop.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * Get the products for the shop.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
