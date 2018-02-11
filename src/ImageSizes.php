<?php 
namespace giorgiosaud\slickwp;

class ImageSizes extends Singleton{
public function __construct()
	{
		add_action( 'init', array($this,'myplugin_images') );
	}	
	public function myplugin_scripts(){
		add_image_size( 'slick_wp_carousel', 600, 400 );
		
	}
}