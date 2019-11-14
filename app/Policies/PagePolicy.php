<?php

namespace App\Policies;

use App\User;
use App\UserRole;

use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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
     * View the page content policy
     * 
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
    	// make sure the user is admin
    	return $user->role->id === UserRole::ADMIN;
    }

    /**
     * Add new page policy
     *
     * @param User $user
     * @return bool
     * 
     */
    public function add(User $user)
    {
    	// make sure the user is admin
    	return $user->role->id === UserRole::ADMIN;
    }

    /**
     * Update the page content policy
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
    	// make sure the user is admin
    	return $user->role->id === UserRole::ADMIN;
    }

    /**
     * Delete the page policy
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
    	// make sure the user is admin
    	return $user->role->id === UserRole::ADMIN;
    }
}
