<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserContactPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Is the user allowed to delete the contact
     * 
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
    	return $user->active;
    }
}
