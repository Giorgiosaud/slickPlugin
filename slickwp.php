<?php
/*
Plugin Name:  Slick Wordpress Giorgiosaud	
Plugin URI:   https://giorgiosaud.com
Description:  Slick integration for Wp
Version:      1.0
Author:       Giorgiosaud
Author URI:   https://giorgiosaud.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
*/

function myplugin_scripts() {
    wp_register_style( 'slckwpGs',  plugin_dir_url( __FILE__ ) . 'slick/slick/slick.css' );
    wp_register_style( 'slckwpGsTheme',  plugin_dir_url( __FILE__ ) . 'slick/slick/slick-theme.css',array('slckwpGs') );
    wp_enqueue_script('slick_wp_gs_ms', plugin_dir_url(__FILE__).'slick/slick/slick.js', array('jquery'), 'version', true);
    wp_enqueue_style( 'slckwpGsTheme' );
    wp_enqueue_script('slick_wp_gs_ms');
}
add_action( 'wp_enqueue_scripts', 'myplugin_scripts' );

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!defined('SLICKWP_FILE')) {
    define('SLICKWP_FILE', __FILE__);
}
if (!defined('SLICKWP_BASE_URL')) {
    define('SLICKWP_BASE_URL', plugin_dir_url(__FILE__));
}

require_once 'vendor/autoload.php';
function slickPlugin()
{
    return \giorgiosaud\slickwp\Initializers::getInstance();
}
$GLOBALS['slickwp'] = slickPlugin();
