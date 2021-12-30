<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'override_name',
    ];



/**
 * Get the shopping list's default name, based on the create date.
 *
 * @return string
 */
public function getDefaultNameAttribute()
{
	// If it's less than a week old, say eg "3 days ago" or "12 hours ago"
	if ( $this->created_at->diffInDays() < 7 ) {
		return $this->created_at->diffForHumans();
	} else { // if it's more than a week old, just show the date
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
	if ($this->override_name)  
    	{
    		return $this->override_name;
    	} else { 
    		return $this->default_name;
    	}
}


    /**
     * Get the family that owns the shopping list.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

}
