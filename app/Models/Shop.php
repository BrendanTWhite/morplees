<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\JustMyFamilyScope;
use App\Traits\BelongsToFamily;

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
