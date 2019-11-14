<?php

namespace App\Policies;

use App\User;
use App\UserContact;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserMessagePolicy
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
     * Check if the user can send the message to the user
     *
     * @param User $from
     * @param User $to
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function send(User $from, User $to)
    {
    	// Make sure, these users are not deactivated or banned
    	if ($from->active == false || $to->active == false) {
    		return false;
    	}

    	// Make sure, it is not the same id
    	return $from->id !== $to->id;
    }

    /**
     * Check if the user can view the message
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user, User $to)
    {
    	$contact = UserContact::where('from', $user->id)
    		->where('to', $to->id)
    		->first();

    	if (!$contact) {
    		return false;
    	}

    	return true;
    }

    /**
     * Check if the user can delete the message
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
    	return $user->active;
    }
}
