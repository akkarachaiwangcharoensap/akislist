<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
	/**
	 * Table
	 * @var const $table
	 */
	protected $table = 'store_categories';

	/**
	 * Computer
	 * @var const COMPUTER
	 */
	public const COMPUTER = 1;

	/**
	 * Book
	 * @var const BOOK
	 */
	public const BOOK = 2;

	/**
	 * Furniture
	 * @var const FURNITURE
	 */
	public const FURNITURE = 3;

	/**
	 * Car
	 * @var const CAR
	 */
	public const CAR = 4;

	/**
	 * Television
	 * @var const TELEVISION
	 */
	public const TELEVISION = 6;

	/**
	 * Free
	 * @var const FREE
	 */
	public const FREE = 7;

	/**
	 * Video Game
	 * @var const VIDEO_GAME
	 */
	public const VIDEO_GAME = 8;

	/**
	 * Electronic
	 * @var const ELECTRONIC
	 */
	public const ELECTRONIC = 9;

	/**
	 * Music
	 * @var const MUSIC
	 */
	public const MUSIC = 10;

	/**
	 * Instrument
	 * @var const INSTRUMENT
	 */
	public const INSTRUMENT = 11;

	/**
	 * Tool
	 * @var const TOOL
	 */
	public const TOOL = 12;

	/**
	 * Cloth
	 * @var const CLOTH
	 */
	public const CLOTH = 13;

	/**
	 * Shoe
	 * @var const SHOE
	 */
	public const SHOE = 14;

	/**
	 * Jacket
	 * @var const JACKET
	 */
	public const JACKET = 15;

	/**
	 * Dress
	 * @var const DRESS
	 */
	public const DRESS = 16;

	/**
	 * Pants
	 * @var const PANTS
	 */
	public const PANTS = 17;

	/**
	 * Ticket
	 * @var const TICKET
	 */
	public const TICKET = 18;

	/**
	 * Material
	 * @var const MATERIAL
	 */
	public const MATERIAL = 19;

	/**
	 * Jewelry
	 * @var const JEWELRY
	 */
	public const JEWELRY = 20;

	/**
	 * Office
	 * @var const OFFICE
	 */
	public const OFFICE = 21;

	/**
	 * Other
	 * @var const OTHER
	 */
	public const OTHER = 22;
}
