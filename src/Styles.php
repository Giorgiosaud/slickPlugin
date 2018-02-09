<?php
namespace giorgiosaud\slickwp;
use giorgiosaud\slickwp\Singleton;

class Styles extends Singleton{
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}