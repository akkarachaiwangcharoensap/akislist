<?php

namespace App\Policies;

use App\User;
use App\SaleItem;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserSaleItemPolicy
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
     * Determine if the user has the permission
     * to view the edit page the sale item post
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function edit(User $user, SaleItem $saleItem)
    {
    	return ($saleItem->user_id == $user->id) && $saleItem->active;
    }

    /**
     * Determine if the user has the permission
     * to delete the sale item post
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function delete(User $user, SaleItem $saleItem)
    {
    	return ($saleItem->user_id == $user->id) && $saleItem->active;
    }

    /**
     * Determine if the user has the permission
     * to update the sale item post
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function save(User $user, SaleItem $saleItem)
    {
    	return ($saleItem->user_id == $user->id) && $saleItem->active;
    }

    /**
     * Determine if the user has the permission
     * to view the preview
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function preview(User $user, SaleItem $saleItem)
    {
    	return ($saleItem->user_id == $user->id) && $saleItem->active;
    }

    /**
     * Determine if the user has the permission
     * to post the sale item post (making it public via posting)
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function post(User $user, SaleItem $saleItem)
    {
    	return ($saleItem->user_id == $user->id) && $saleItem->active;
    }

    /**
     * Determine if the user has the permission
     * to report the sale item post
     *
     * @param User $user
     * @param SaleItem $saleItem
     *
     * @return bool
     */
    public function report(User $user, SaleItem $saleItem)
    {
    	return ($saleItem->user_id != $user->id) && $saleItem->active;
    }
}
