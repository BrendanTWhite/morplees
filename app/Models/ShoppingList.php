<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;
    use BelongsToFamily;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'override_name',
        'active',
        'family_id',
        'include_need_soon',
        'include_usually_need',
        'copy_recipes',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = null;

    protected $casts = [
        'include_need_soon' => 'boolean',
        'include_usually_need' => 'boolean',
        'copy_recipes' => 'boolean',
    ];

    public function toggleActive()
    {
        $this->active = ! $this->active;
        $this->save();
    }

    /**
     * Get the shopping list's default name, based on the create date.
     *
     * @return string
     */
    public function getDefaultNameAttribute()
    {
        // If it's less than five minutes old, say "just now"
        if ($this->created_at->diffInMinutes() < 5) {
            return 'Just Now';
        } elseif // If it's less than a month old, say eg "3 days ago" or "12 hours ago"
        ($this->created_at->diffInDays() < 28) {
            return $this->created_at->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_AUTO, false, 2);
        } else { // if it's more than a month old, just show the date
            return $this->created_at->toFormattedDateString();
        }
    }

    /**
     * Get the shopping list's display name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        if ($this->override_name) {
            return $this->override_name;
        } else {
            return $this->default_name;
        }
    }

    /**
     * Get the ID of the currently active shopping list.
     */
    public static function getActiveSL(): ?ShoppingList
    {
        return self::firstOrCreate(['active' => true]);
    }

    /**
     * Get the family that owns the shopping list.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * Get the SL Recipes for this record.
     */
    public function s_l_recipes() // snake for Filament
    {
        return $this->hasMany(SLRecipe::class);
    }

    /**
     * Get the SL Recipes for this record.
     */
    public function sLRecipes() // Camel for seeder
    {
        return $this->hasMany(SLRecipe::class);
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
