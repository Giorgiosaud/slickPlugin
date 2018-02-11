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
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!defined('SLICKWP_FILE')) {
    define('SLICKWP_FILE', __FILE__);
}
if (!defined('SLICKWP_BASE_URL')) {
    define('SLICKWP_BASE_URL', plugin_dir_url( __FILE__ ));
}
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}
require_once 'vendor/autoload.php';
function slickPlugin()
{
    return \giorgiosaud\slickwp\Initializers::getInstance();
}
$GLOBALS['slickwp'] = slickPlugin();
