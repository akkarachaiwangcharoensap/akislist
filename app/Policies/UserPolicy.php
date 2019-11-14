<?php

namespace App\Policies;

use App\User;
use App\UserRole;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine if the user has permission to deactivate
     * an account
     *
     * @param User $user
     * @param User $to
     *
     * @return bool
     */
    public function deactivate(User $user, User $to)
    {
    	// Admin cannot deactivate admin users
    	if ($to->role->id == UserRole::ADMIN) {
    		return false;
    	}

    	return $user->role->id == UserRole::ADMIN;
    }

    /**
     * Determine if the user has the permission to criminalize
     * an account
     *
     * @param User $user
     * @param User $to
     *
     * @return bool
     */
    public function criminalize(User $user, User $to)
    {	
    	// Admin cannot criminalize admin users
    	if ($to->role->id == UserRole::ADMIN) {
    		return false;
    	}

    	return $user->role->id == UserRole::ADMIN;
    }
}
