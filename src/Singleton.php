<?php
namespace giorgiosaud\slickwp;
class Singleton{
	private static $_instance = null;
	public static function instance()
	{
		die(var_dump('kdmclsm'));
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}