<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFamily;

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


}
