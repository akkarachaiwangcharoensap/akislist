<?php

namespace App\Policies;

use App\User;
use App\UserRole;

use App\SaleItem;

use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserSaleItemPolicy
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
     * Make sure the admin user has 
     * the permission to deactive the given sale item post
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function deactivate(User $user, SaleItem $saleItem)
    {
    	return $user->role->id == UserRole::ADMIN && $saleItem->active;
    }
}
