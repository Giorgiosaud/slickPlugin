<?php 
namespace giorgiosaud\slickwp\shortcodes;
use giorgiosaud\slickwp\Singleton;
class slickShortcode extends Singleton{
	public function __construct()
	{
		add_shortcode('slickwp',array($this,'show'));
	}
	public function show(){
		return '<p>slickwp</p>';
	}
}

