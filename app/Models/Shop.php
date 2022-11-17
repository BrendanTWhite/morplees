<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
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
