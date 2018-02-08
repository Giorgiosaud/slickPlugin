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
            'Agro Theme Settings',
            'AgroTheme',
            'manage_options',
            'agro_theme',
            array( $this, 'createAdminPage' )
        );
        add_submenu_page(
            'agro_theme',
            'Agro Theme Settings',
            'Agro Theme Main Settings',
            'manage_options',
            'agro_theme',
            array( $this, 'createAdminPage' )
        );
        add_submenu_page(
            'agro_theme',
            'Agro Theme Webhook Settings',
            'Agro Theme Webhook Setup',
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
        $this->options = get_option('agro_theme');
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('agro_theme_settings');
                do_settings_sections('agro_theme');
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
        $this->options = get_option('agro_theme');
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('agro_theme_settings');
                do_settings_sections('agro_theme_webhook');
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
            'agro_theme_settings', // Option group
            'agro_theme', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'agro_theme_main_setting', // ID
            'Giorgio Plugin My Webhook Settings', // pass
            array( $this, 'printSectionInfo' ), // Callback
            'agro_theme_webhook' // Page
        );
        add_settings_field(
            'secret',
            'Secret',
            array( $this, 'passCallback' ),
            'agro_theme_webhook',
            'agro_theme_main_setting'
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
        _e('Enter your Webhook Settings below:', 'agro_theme');
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
            '<input type="text" id="secret" name="agro_theme[secret]" value="%s" />',
            isset($this->options['secret']) ? esc_attr($this->options['secret']) : ''
        );
    }
}
