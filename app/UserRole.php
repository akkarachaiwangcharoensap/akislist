<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{	
	/**
	 * Default user's role
	 * @var const DEFAULT
	 */
	public const DEFAULT = 1;

	/**
	 * Adminstrative User
	 * @var const ADMIN
	 */
	public const ADMIN = 2;

	/**
	 * Table
	 * @var string $table
	 */
    protected $table = 'user_roles';
}
