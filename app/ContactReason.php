<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactReason extends Model
{
	/**
	 * Business constant
	 * @var const BUSINESS
	 */
    public const BUSINESS = 1;

    /**
	 * Support constant
	 * @var const SUPPORT
	 */
    public const SUPPORT = 2;

    /**
	 * Legal constant
	 * @var const LEGAL
	 */
    public const LEGAL = 3;

    /**
	 * GENERAL constant
	 * @var const GENERAL
	 */
    public const GENERAL = 4;

    /**
	 * FEATURE_REQUEST constant
	 * @var const FEATURE_REQUEST
	 */
    public const FEATURE_REQUEST = 5;

    /**
	 * FAQ constant
	 * @var const FAQ
	 */
    public const FAQ = 6;

    /**
	 * STORE constant
	 * @var const STORE
	 */
    public const STORE = 7;

    /**
	 * ISSUES constant
	 * @var const ISSUES
	 */
    public const ISSUES = 8;
}
