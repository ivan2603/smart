<?php

namespace app\SBlog\Core;

/**
 * Class BlogApp
 * @package app\SBlog\Core
 */
class BlogApp
{
	/**
	 * @var
	 */
	public static $app;

	/**
	 * @return TSingleton
	 */
	public static function getInstance() {

		self::$app = Registry::instance();
		self::getParams();
		return self::$app;
	}

	/**
	 * Get params fro file
	 */
	protected static function getParams() {

		$params = require CONF.'/params.php';

		if (!empty($params)) {
			foreach ($params as $key => $value) {
				self::$app->setProperty($key, $value);
			}
		}
	}
}