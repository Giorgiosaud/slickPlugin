<?php
namespace giorgiosaud\slickwp;

class Initializers
{
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param string|bool $value Constant value.
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
	public function __construct()
	{
		$this->defineConstants();

		$this->initHooks();
		if (is_admin()) {
			$my_settings_page = new Options();
		}
		do_action('giorgioslickplugin_loaded');
	}
	private function defineConstants()
	{
		$upload_dir = wp_upload_dir(null, false);
		$this->define('SLICKWP_ABSPATH', dirname(SLICKWP_FILE) . '/');
		$this->define('SLICKWP_BASENAME', plugin_basename(SLICKWP_FILE));
		$this->define('SLICKWP_VERSION', $this->version);
	}
    /**
     * Initialize Hooks
     */
    private function initHooks()
    {
    	
        // register_activation_hook( WEDCONTEST_PLUGIN_FILE, array( Install::class, 'install' ) );
        // new \Zonapro\WedContest\Capabilities\Initialize();

        // register_deactivation_hook(WEDCONTEST_PLUGIN_FILE, array( Uninstall::class, 'uninstall' ));
        // new \Zonapro\WedContest\CustomPosts\Initialize();
        // new \Zonapro\WedContest\Capabilities\Initialize();
        // add_action('init',array('\Zonapro\WedContest\PostTypes','create'));
        // add_action('init',array('\Zonapro\WedContest\Capabilities','update'));
        // register_shutdown_function( array( $this, 'log_errors' ) );
        // new \Zonapro\WedContest\Shortcodes\Initialize();
        // new \Zonapro\WedContest\Widgets\Initialize();
        // add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
        // add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
        // add_action( 'init', array( $this, 'init' ), 0 );
        // add_action( 'init', array( 'WedContest_Shortcodes', 'init' ) );
        // add_action( 'init', array( 'WC_Emails', 'init_transactional_emails' ) );
        // add_action( 'init', array( $this, 'wpdb_table_fix' ), 0 );
        // add_action( 'switch_blog', array( $this, 'wpdb_table_fix' ), 0 );
    }
}