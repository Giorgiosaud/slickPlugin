<?php
namespace giorgiosaud\slickwp;
class StylesAndScripts extends Singleton{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array($this,'myplugin_scripts') );
	}	
	public function myplugin_scripts(){
		wp_register_style( 'slckwpGs',  plugin_dir_url( __FILE__ ) . 'slick/slick/slick.css' );
		wp_register_style( 'slckwpGsTheme',  plugin_dir_url( __FILE__ ) . 'slick/slick/slick-theme.css',array('slckwpGs') );
		wp_enqueue_script('slick_wp_gs_ms', plugin_dir_url(__FILE__).'slick/slick/slick.js', array('jquery'), 'version', true);
		wp_enqueue_style( 'slckwpGsTheme' );
		wp_enqueue_script('slick_wp_gs_ms');
	}
}