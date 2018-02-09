<?php 
namespace giorgiosaud\slickwp\shortcodes;
use giorgiosaud\slickwp\Singleton;
class slickShortcode{
	public function __construct()
	{
		add_shortcode('slickwp',array($this,'execute'));
	}
	public function execute($atts){
		$atts = shortcode_atts(
			array(
				'post_type' => 'post',
				'category' => '',
			), $atts, 'slickwp' );

	return 'atts: ' . $atts['post_type'] . ' ' . $atts['category'];
	}
}

