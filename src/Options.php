<?php
namespace giorgiosaud\slickwp;

class Options
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array( $this, 'addPluginPage'));
        add_action('admin_init', array( $this, 'pageInit' ));
    }

    /**
     * Add options page
     */
    public function addPluginPage()
    {
        add_menu_page(
            'Slick Settings',
            'Slick',
            'manage_options',
            'slick_wp_plugin',
            array( $this, 'createAdminPage' )
        );
        add_submenu_page(
            'slick_wp_plugin',
            'Slick Wp Settings',
            'Slick Wp Main Settings',
            'manage_options',
            'slick_wp_plugin',
            array( $this, 'createAdminPage' )
        );
        add_submenu_page(
            'slick_wp_plugin',
            'Slick Wp Webhook Settings',
            'Slick Wp Webhook Setup',
            'manage_options',
            'giorgioplugin_webhook',
            array( $this, 'createWebhookAdminPage' )
        );
        // This page will be under "Settings"
    }
    /**
     * Options page callback
     */
    public function createAdminPage()
    {
        // Set class property
        $this->options = get_option('slick_wp_plugin');
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('slick_wp_plugin_settings');
                do_settings_sections('slick_wp_plugin');
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }
    /**
     * Options page callback
     */
    public function createWebhookAdminPage()
    {
        // Set class property
        $this->options = get_option('slick_wp_plugin');
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('slick_wp_plugin_settings');
                do_settings_sections('slick_wp_plugin_webhook');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function pageInit()
    {
        register_setting(
            'slick_wp_plugin_settings', // Option group
            'slick_wp_plugin', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'slick_wp_plugin_main_setting', // ID
            'Giorgio Plugin My Webhook Settings', // pass
            array( $this, 'printSectionInfo' ), // Callback
            'slick_wp_plugin_webhook' // Page
        );
        add_settings_field(
            'secret',
            'Secret',
            array( $this, 'passCallback' ),
            'slick_wp_plugin_webhook',
            'slick_wp_plugin_main_setting'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();
        // if( isset( $input['id_number'] ) )
        //  $new_input['id_number'] = absint( $input['id_number'] );

        if (isset($input['secret'])) {
            $new_input['secret'] = sanitize_text_field($input['secret']);
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function printSectionInfo()
    {
        _e('Enter your Webhook Settings below:', 'slick_wp_plugin');
    }

    /**
     * Get the settings option array and print one of its values
     */
    // public function id_number_callback()
    // {
    //  printf(
    //      '<input type="text" id="id_number" name="wedcontest[id_number]" value="%s" />',
    //      isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
    //  );
    // }

    /**
     * Get the settings option array and print one of its values
     */
    public function passCallback()
    {
        printf(
            '<input type="text" id="secret" name="slick_wp_plugin[secret]" value="%s" />',
            isset($this->options['secret']) ? esc_attr($this->options['secret']) : ''
        );
    }
}
