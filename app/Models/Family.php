<?php

namespace App\Models;

use App\Actions\AddDefaultContentToNewFamily;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\IcalendarGenerator\Components\Calendar;

class Family extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'ical_active',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = [
        'name',
    ];

    const REFRESH_INTERVAL_IN_MINUTES = 2 * 60; // ie two hours

    public function getCalendarAttribute()
    {
        // If the family has their calendar switched off, just return a 404
        if (! $this->ical_active) {
            abort(404);
        }

        $calendar = Calendar::create()
            ->withoutTimezone()
            ->name('Morplees')
            ->description('Morplees Meal Calendar for '.$this->name)
            ->refreshInterval(self::REFRESH_INTERVAL_IN_MINUTES);

        foreach ($this->shoppingLists as $shoppingList) {
            foreach ($shoppingList->sLRecipes as $sLRecipe) {
                if ($sLRecipe->date) {
                    $calendar->event($sLRecipe->getEvent());
                }
            }
        }

        return $calendar->get();
    }

    protected $casts = [
        'ical_active' => 'boolean',
    ];

    /**
     * Get the users for the family.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the shops for the family.
     */
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    /**
     * Get the recipes for the family.
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    /**
     * Get the shopping lists for the family.
     */
    public function shopping_lists() // snake case for Filament
    {
        return $this->hasMany(ShoppingList::class);
    }

    /**
     * Get the shopping lists for the family.
     */
    public function shoppingLists() // camel case for seeder
    {
        return $this->hasMany(ShoppingList::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Note that JustMyFamilyScope checks the family_id foreign key
        // which doesn' exist on a Family. We need to just check the id

        static::addGlobalScope('this_family', function (Builder $builder) {
            if (session()->has('family_id')) {
                return $builder->where('id', '=', session(key: 'family_id'));
            } else {
                return $builder;
            }
        });

        static::creating(function ($family) {
            $family->ical_uuid = (string) Str::uuid();
        });

        static::created(function ($family) {
            
            $addDefault = new AddDefaultContentToNewFamily;
            $addDefault->execute($family);

        });

    }
}
