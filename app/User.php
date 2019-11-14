<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\WelcomeNotification;
use App\Notifications\AccountConfirmationNotification;
use App\Notifications\CustomPasswordResetNotification as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Users Table
     * @var string $table
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'password', 'confirmation_token', 'confirmed', 'unique_string', 'ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_token', 'ip'
    ];


    /**
   	 * Confirm the user account
   	 *
   	 * @param string $token
   	 * @return void
   	 */
    public function confirm($token)
    {
    	$this->update(array(
    		'confirmed' => true,
    		'confirmation_token' => null
    	));

    	$this->notify(new WelcomeNotification($this));
    }

    /**
   	 * Resend confirmation email
   	 * @return void
   	 */
    public function resend()
    {
		$this->notify(new AccountConfirmationNotification($this));
    }

    /**
     * Get the role of the user
     * @return App\UserRole
     */
    public function role()
    {
    	return $this->belongsTo('App\UserRole', 'user_role_id');
    }

    /**
     * Get all reports on this user
     * @return App\Report
     */
    public function reports()
    {
    	return $this->hasMany('App\Report', 'to');
    }

    /**
     * Sale items
     * @return Collection App\SaleItem
     */
    public function saleItems()
    {
    	return $this->hasMany('App\SaleItem', 'user_id');
    }

    /**
     * user imcoming messages
     * @return Collection App\SaleItemMessage
     */
    public function messages()
    {
    	return $this->hasMany('App\SaleItemMessage', 'to');
    }

    /**
     * Get communication of the user
     * @return Collection SaleItemMessage
     */
    public function getCommunication()
    {
    	$from = SaleItemMessage::where('from', $this->id)
    		->where('active', true)
    		->get();

    	$to = SaleItemMessage::where('to', $this->id)
    		->where('active', true)
    		->get();

    	return $from->merge($to)->unique('sale_item_id');
    }

    /**
     * Is the user a criminal
     * @return App\Criminal
     */
    public function criminal()
    {
    	return $this->hasOne('App\Criminal', 'user_id');
    }

    /**
     * @override
     *
     * Send reset notification email
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
    	$this->notify(new ResetPasswordNotification($token));
    }
}






