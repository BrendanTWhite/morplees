<?php

namespace App\Models;

use App\Traits\BelongsToFamily;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use BelongsToFamily;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'family_id',
    ];

    /**
     * The attributes that should be masked by DatabaseMask.
     *
     * @var array
     */
    protected $masked = [
        'name', 'email', 'password',
    ];

    public function canAccessFilament(): bool
    {

        // If you want only Admins to see Filament, un-commment the following line
        //return $this->is_admin;

        // If you want everyone to see Filament, un-comment this line
        return true;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($user) {

            if (! $user->password) {
                $user->password = (string) Str::uuid();
            }

            if ( ! $user->family_id ) {
                $user->family_id = Family::create([
                    'name' => $user->name . '\'s family',
                ])->id;
            }

        });
    }

    /**
     * Get the family that owns the user.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
