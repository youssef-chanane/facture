<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Taxe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxePolicy
{
    use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view any models.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return mixed
    //  */
    // public function viewAny(User $user)
    // {
    //     //
    // }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Taxe  $taxe
     * @return mixed
     */
    public function view(User $user, Taxe $taxe)
    {
        return $user->id===$taxe->user_id ;
    }

    // /**
    //  * Determine whether the user can create models.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return mixed
    //  */
    // public function create(User $user)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can update the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Taxe  $taxe
    //  * @return mixed
    //  */
    // public function update(User $user, Taxe $taxe)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Taxe  $taxe
    //  * @return mixed
    //  */
    // public function delete(User $user, Taxe $taxe)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Taxe  $taxe
    //  * @return mixed
    //  */
    // public function restore(User $user, Taxe $taxe)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Taxe  $taxe
    //  * @return mixed
    //  */
    // public function forceDelete(User $user, Taxe $taxe)
    // {
    //     //
    // }
}
