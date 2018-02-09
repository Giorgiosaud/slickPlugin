<?php
namespace giorgiosaud\slickwp;

class StylesAndScripts{
	public function __construct()
	{
	add_action( 'wp_enqueue_scripts', array($this,'slickwp_scripts' ));
	}
	public function slickwp_scripts(){
		    wp_register_style( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'assets/foo-styles.css' );
    wp_enqueue_style( 'foo-styles' );


	}
}