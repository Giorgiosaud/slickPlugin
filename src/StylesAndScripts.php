<?php
namespace giorgiosaud\slickwp;

class StylesAndScripts{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array($this,'styles') );
	}
	public function styles(){
		wp_register_style( 'slickWpGs', plugins_url( '/slick/slick/slick.css', __FILE__ ), array('jquery'), '1.8.0', 'all' );
		wp_enqueue_style( 'slickWpGs');

	}
}