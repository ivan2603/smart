<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.02.20
 * Time: 18:02
 */

namespace app\SBlog\Core;


/**
 * Class TSingleton
 * @package app\SBlog\Core
 */
trait TSingleton
{
	/**
	 * @var
	 */
	private static $instance;

	/**
	 * @return TSingleton
	 */
	public static function instance() {

		if (self::$instance === null) {
			self::$instance = new self;
		}
		return self::$instance;
	}

}