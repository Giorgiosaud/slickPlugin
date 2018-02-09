<?php
namespace giorgiosaud\slickwp;
use giorgiosaud\slickwp\Singleton;

class StylesAndScripts extends Singleton{
	public function __construct()
	{
		wp_register_style( 'slickWpGs', plugins_url( '/slick/slick/slick.css', __FILE__ ), array('jquery'), '1.8.0', 'all' );
		wp_enqueue_style( 'slickWpGs');
	}
}