<?php 
namespace giorgiosaud\slickwp\shortcodes;
class slickShortcode{
	public function __construct()
	{
		add_shortcode('slickwp',array($this,'show'));
	}
	public function show(){
		echo '<p>slickwp</p>';
	}
}

