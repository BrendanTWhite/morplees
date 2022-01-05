<?php

namespace App\Policies;

use App\Models\SLItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SLItemPolicy
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
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SLItem $sLItem)
    {
        return ($user->family_id === $sLItem->shopping_list->family_id) or ($user->is_admin);
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
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SLItem $sLItem)
    {
        return ($user->family_id === $sLItem->shopping_list->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SLItem $sLItem)
    {
        return ($user->family_id === $sLItem->shopping_list->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SLItem $sLItem)
    {
        return ($user->family_id === $sLItem->shopping_list->family_id) or ($user->is_admin);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SLItem  $sLItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SLItem $sLItem)
    {
        return false;
    }
}
