<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\JustMyFamilyScope;

class Recipe extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family_id',
        'prep_time',
        'cook_time',
        'book_reference',
        'url',
    ];




    /**
     * Get the family that owns the recipe.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    
    /**
     * Get the ingredients for the recipe.
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    
    /**
     * Get the steps for the recipe.
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    
    /**
     * Get the SL Recipes for this record.
     */
    public function s_l_recipes()
    {
        return $this->hasMany(SLRecipe::class);
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
