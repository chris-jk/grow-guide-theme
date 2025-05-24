<?php
/**
 * Plugin Name: Grow Guide Director
 * Plugin URI: https://growguide.app
 * Description: A comprehensive plugin to direct users within the Grow Guide app with smart deep linking, fallbacks, and user experience enhancements.
 * Version: 1.0.0
 * Author: Grow Guide Team
 * License: GPL v2 or later
 * Text Domain: grow-guide-director
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('GGD_VERSION', '1.0.0');
define('GGD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('GGD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('GGD_PLUGIN_FILE', __FILE__);

/**
 * Main Grow Guide Director Class
 */
class GrowGuideDirector {
    
    private static $instance = null;
    
    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_head', array($this, 'add_head_scripts'));
        add_action('wp_ajax_ggd_track_interaction', array($this, 'track_interaction'));
        add_action('wp_ajax_nopriv_ggd_track_interaction', array($this, 'track_interaction'));
        
        // Add shortcodes
        add_shortcode('app_link', array($this, 'app_link_shortcode'));
        add_shortcode('smart_redirect', array($this, 'smart_redirect_shortcode'));
        
        // Add admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Register activation hook
        register_activation_hook(__FILE__, array($this, 'activate'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Add rewrite rules for app paths
        $this->add_rewrite_rules();
        
        // Handle app redirections
        add_action('template_redirect', array($this, 'handle_app_redirections'));
    }
    
    /**
     * Add rewrite rules for app paths
     */
    public function add_rewrite_rules() {
        $app_paths = $this->get_app_paths();
        
        foreach ($app_paths as $path) {
            add_rewrite_rule(
                '^' . $path . '(.*)/?',
                'index.php?ggd_app_path=' . $path . '&ggd_app_params=$matches[1]',
                'top'
            );
        }
        
        // Add query vars
        add_filter('query_vars', function($vars) {
            $vars[] = 'ggd_app_path';
            $vars[] = 'ggd_app_params';
            return $vars;
        });
    }
    
    /**
     * Handle app redirections
     */
    public function handle_app_redirections() {
        $app_path = get_query_var('ggd_app_path');
        $app_params = get_query_var('ggd_app_params');
        
        if ($app_path) {
            $this->redirect_to_app($app_path, $app_params);
        }
    }
    
    /**
     * Redirect to app with fallback
     */
    public function redirect_to_app($path, $params = '') {
        $config = $this->get_config();
        $full_path = $path . $params;
        $deep_link = $config['app_scheme'] . $full_path;
        
        // Create fallback URL
        $fallback_url = home_url('/app-redirect/?path=' . urlencode($full_path));
        
        // Load redirect template
        include(GGD_PLUGIN_DIR . 'templates/app-redirect.php');
        exit;
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            'ggd-director',
            GGD_PLUGIN_URL . 'assets/js/director.js',
            array('jquery'),
            GGD_VERSION,
            true
        );
        
        wp_enqueue_style(
            'ggd-director',
            GGD_PLUGIN_URL . 'assets/css/director.css',
            array(),
            GGD_VERSION
        );
        
        // Localize script with config
        wp_localize_script('ggd-director', 'ggdConfig', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ggd_nonce'),
            'config' => $this->get_config()
        ));
    }
    
    /**
     * Add head scripts for immediate execution
     */
    public function add_head_scripts() {
        $config = $this->get_config();
        ?>
        <script>
        window.ggdConfig = <?php echo json_encode($config); ?>;
        
        // Immediate app detection and redirection
        (function() {
            const currentPath = window.location.pathname;
            const appPaths = <?php echo json_encode($this->get_app_paths()); ?>;
            
            for (let path of appPaths) {
                if (currentPath.startsWith('/' + path)) {
                    // Try to open app immediately
                    const deepLink = window.ggdConfig.app_scheme + currentPath.slice(1);
                    window.location.href = deepLink;
                    
                    // Fallback after timeout
                    setTimeout(function() {
                        if (document.hasFocus()) {
                            // App didn't open, show store badges
                            window.ggdShowAppPrompt && window.ggdShowAppPrompt();
                        }
                    }, 1500);
                    break;
                }
            }
        })();
        </script>
        <?php
    }
    
    /**
     * App link shortcode
     */
    public function app_link_shortcode($atts, $content = '') {
        $atts = shortcode_atts(array(
            'path' => '',
            'text' => $content ?: 'Open in App',
            'class' => 'ggd-app-link btn',
            'fallback' => 'store'
        ), $atts);
        
        $config = $this->get_config();
        $deep_link = $config['app_scheme'] . $atts['path'];
        
        return sprintf(
            '<a href="%s" class="%s" data-ggd-link="%s" data-fallback="%s">%s</a>',
            esc_url($deep_link),
            esc_attr($atts['class']),
            esc_attr($atts['path']),
            esc_attr($atts['fallback']),
            esc_html($atts['text'])
        );
    }
    
    /**
     * Smart redirect shortcode
     */
    public function smart_redirect_shortcode($atts) {
        $atts = shortcode_atts(array(
            'path' => '',
            'delay' => '1000',
            'message' => 'Redirecting to app...'
        ), $atts);
        
        ob_start();
        ?>
        <div class="ggd-smart-redirect" data-path="<?php echo esc_attr($atts['path']); ?>" data-delay="<?php echo esc_attr($atts['delay']); ?>">
            <div class="ggd-redirect-message">
                <div class="ggd-spinner"></div>
                <p><?php echo esc_html($atts['message']); ?></p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Track user interactions
     */
    public function track_interaction() {
        check_ajax_referer('ggd_nonce', 'nonce');
        
        $interaction_type = sanitize_text_field($_POST['type']);
        $path = sanitize_text_field($_POST['path']);
        $user_agent = sanitize_text_field($_SERVER['HTTP_USER_AGENT']);
        
        // Store interaction data
        $interaction_data = array(
            'type' => $interaction_type,
            'path' => $path,
            'user_agent' => $user_agent,
            'timestamp' => current_time('mysql'),
            'ip' => $_SERVER['REMOTE_ADDR']
        );
        
        // Save to database or external service
        $this->save_interaction($interaction_data);
        
        wp_send_json_success();
    }
    
    /**
     * Save interaction to database
     */
    private function save_interaction($data) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ggd_interactions';
        
        $wpdb->insert($table_name, $data);
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_options_page(
            'Grow Guide Director',
            'App Director',
            'manage_options',
            'grow-guide-director',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Admin page
     */
    public function admin_page() {
        if (isset($_POST['submit'])) {
            $this->save_settings();
        }
        
        include(GGD_PLUGIN_DIR . 'templates/admin-page.php');
    }
    
    /**
     * Save settings
     */
    private function save_settings() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        check_admin_referer('ggd_save_settings');
        
        $settings = array(
            'app_scheme' => sanitize_text_field($_POST['app_scheme']),
            'app_store_url' => esc_url_raw($_POST['app_store_url']),
            'play_store_url' => esc_url_raw($_POST['play_store_url']),
            'fallback_behavior' => sanitize_text_field($_POST['fallback_behavior'])
        );
        
        update_option('ggd_settings', $settings);
        
        echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
    }
    
    /**
     * Get plugin configuration
     */
    public function get_config() {
        $defaults = array(
            'app_scheme' => 'growguide://',
            'app_store_url' => 'https://apps.apple.com/us/app/grow-guide/id6637720578',
            'play_store_url' => 'https://play.google.com/store/apps/details?id=app.growguide',
            'fallback_behavior' => 'store'
        );
        
        $settings = get_option('ggd_settings', array());
        
        return array_merge($defaults, $settings);
    }
    
    /**
     * Get app paths that trigger redirection
     */
    public function get_app_paths() {
        return apply_filters('ggd_app_paths', array(
            'user',
            'post',
            'grow',
            'tools',
            'mygrows',
            'questions',
            'admin',
            'profile',
            'settings',
            'help'
        ));
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Create interactions table
        $this->create_interactions_table();
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Create interactions table
     */
    private function create_interactions_table() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ggd_interactions';
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            type varchar(50) NOT NULL,
            path varchar(255) NOT NULL,
            user_agent text,
            timestamp datetime DEFAULT CURRENT_TIMESTAMP,
            ip varchar(45),
            PRIMARY KEY (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

// Initialize the plugin
function ggd_init() {
    return GrowGuideDirector::get_instance();
}

// Hook into WordPress
add_action('plugins_loaded', 'ggd_init');

// Helper functions for theme use
function ggd_app_link($path, $text = 'Open in App', $class = 'ggd-app-link btn') {
    $director = GrowGuideDirector::get_instance();
    $config = $director->get_config();
    $deep_link = $config['app_scheme'] . $path;
    
    return sprintf(
        '<a href="%s" class="%s" data-ggd-link="%s">%s</a>',
        esc_url($deep_link),
        esc_attr($class),
        esc_attr($path),
        esc_html($text)
    );
}

function ggd_redirect_to_app($path) {
    $director = GrowGuideDirector::get_instance();
    $director->redirect_to_app($path);
}
