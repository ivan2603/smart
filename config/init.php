<?php

if (!defined('ROOT')) define('ROOT', dirname(__DIR__));
if (!defined('APP')) define('APP', ROOT.'/app');
if (!defined('CORE')) define('CORE', ROOT.'/resources');
if (!defined('LIBS')) define('LIBS', ROOT.'/resources/libs');
if (!defined('CACHE')) define('CACHE', ROOT.'/tmp/cache');
if (!defined('CONF')) define('CONF', ROOT.'/config');
if (!defined('LAYOUT')) define('LAYOUT', ROOT.'app.blade.php');
if (!defined('GALLERY')) define('GALLERY', ROOT.'/public/uploads/gallery');
if (!defined('IMG')) define('IMG', ROOT.'/public/uploads/single');

$host = false;

if (isset($_SERVER['HTTP_HOST'])) {
	$host = $_SERVER['HTTP_HOST'];
}

$allowed_hosts = 'http://127.0.0.1:8000/index.php';

$app_path = preg_replace('#[^/]+$#','', $allowed_hosts);

if (!defined('PATH')) define('PATH', $app_path);
if (!defined('ADMIN')) define('ADMIN', PATH.'admin/index');
