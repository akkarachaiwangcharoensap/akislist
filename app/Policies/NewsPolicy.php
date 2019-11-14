<?php

namespace App\Policies;

use App\User;
use App\UserRole;

use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
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
     * Make sure the user has 
     * the permission to view post
     * 
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
    	return $user->role->id === UserRole::ADMIN;
    }

    /**
     * Make sure the user has 
     * the permission to add new post
     *
     * @param User $user
     * @return bool
     */
    public function add(User $user)
    {
    	return $user->role->id === UserRole::ADMIN;
    }

    /**
     * Make sure the user has
     * the permission to update the post
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
    	return $user->role->id === UserRole::ADMIN;
    }

    /**
     * Make sure the user has 
     * the permission to delete post
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
    	return $user->role->id === UserRole::ADMIN;
    }
}
