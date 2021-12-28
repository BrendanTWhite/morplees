<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
