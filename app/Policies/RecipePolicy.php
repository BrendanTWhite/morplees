<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Recipe $recipe)
    {
        return ($user->family_id === $recipe->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Recipe $recipe)
    {
        return ($user->family_id === $recipe->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Recipe $recipe)
    {
        return ($user->family_id === $recipe->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Recipe $recipe)
    {
        return ($user->family_id === $recipe->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Recipe $recipe)
    {
        return false;
    }
}
