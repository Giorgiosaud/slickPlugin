<?php
namespace giorgiosaud\slickwp;
class Singleton{
	protected static $_instance = null;
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			parent::$_instance = new parent();
		}
		return self::$_instance;
	}
}