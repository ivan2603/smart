<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.02.20
 * Time: 18:07
 */

namespace app\SBlog\Core;


/**
 * Class Registry
 * @package app\SBlog\Core
 */
class Registry
{
	use TSingleton;

	/**
	 * @var array
	 */
	protected static $properties = [];

	/**
	 * @param $name
	 * @param $value
	 */
	public function setProperty($name, $value)
	{
		self::$properties[$name] = $value;
	}

	/**
	 * @param $name
	 *
	 * @return mixed|null
	 */
	public function getProperty($name) {

		if (isset(self::$properties[$name])) {
			return self::$properties[$name];
		}
		return null;
	}

	/**
	 * @return array
	 */
	public function getProperties()
	{
		return self::$properties;
	}
}