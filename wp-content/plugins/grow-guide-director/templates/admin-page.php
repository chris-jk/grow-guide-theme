<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$config = $this->get_config();
?>

<div class="wrap">
    <h1>
        <span class="dashicons dashicons-smartphone" style="font-size: 32px; margin-right: 8px; color: #4CAF50;"></span>
        Grow Guide Director Settings
    </h1>
    
    <p class="description">
        Configure how users are redirected to the Grow Guide mobile app with smart deep linking and fallback options.
    </p>
    
    <form method="post" action="">
        <?php wp_nonce_field('ggd_save_settings'); ?>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="app_scheme">App URL Scheme</label>
                    </th>
                    <td>
                        <input 
                            type="text" 
                            id="app_scheme" 
                            name="app_scheme" 
                            value="<?php echo esc_attr($config['app_scheme']); ?>" 
                            class="regular-text"
                            placeholder="growguide://"
                        >
                        <p class="description">
                            The custom URL scheme for your mobile app (e.g., growguide://)
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="app_store_url">App Store URL</label>
                    </th>
                    <td>
                        <input 
                            type="url" 
                            id="app_store_url" 
                            name="app_store_url" 
                            value="<?php echo esc_attr($config['app_store_url']); ?>" 
                            class="regular-text"
                            placeholder="https://apps.apple.com/us/app/..."
                        >
                        <p class="description">
                            The Apple App Store URL for your iOS app
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="play_store_url">Google Play Store URL</label>
                    </th>
                    <td>
                        <input 
                            type="url" 
                            id="play_store_url" 
                            name="play_store_url" 
                            value="<?php echo esc_attr($config['play_store_url']); ?>" 
                            class="regular-text"
                            placeholder="https://play.google.com/store/apps/details?id=..."
                        >
                        <p class="description">
                            The Google Play Store URL for your Android app
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="fallback_behavior">Fallback Behavior</label>
                    </th>
                    <td>
                        <select id="fallback_behavior" name="fallback_behavior">
                            <option value="store" <?php selected($config['fallback_behavior'], 'store'); ?>>
                                Show App Store Badges
                            </option>
                            <option value="modal" <?php selected($config['fallback_behavior'], 'modal'); ?>>
                                Show Download Modal
                            </option>
                            <option value="web" <?php selected($config['fallback_behavior'], 'web'); ?>>
                                Continue on Web
                            </option>
                        </select>
                        <p class="description">
                            What to do when the app can't be opened
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php submit_button('Save Settings'); ?>
    </form>
    
    <hr>
    
    <div class="ggd-admin-section">
        <h2>Usage Examples</h2>
        
        <div class="ggd-usage-examples">
            <div class="ggd-example">
                <h3>Shortcode: App Link</h3>
                <p>Create a button that opens the app at a specific path:</p>
                <code>[app_link path="user/profile" text="Open Profile" class="btn btn-primary"]</code>
            </div>
            
            <div class="ggd-example">
                <h3>Shortcode: Smart Redirect</h3>
                <p>Automatically redirect users to the app with a loading message:</p>
                <code>[smart_redirect path="post/123" delay="1000" message="Loading your post..."]</code>
            </div>
            
            <div class="ggd-example">
                <h3>PHP Function: App Link</h3>
                <p>Generate app links in your theme:</p>
                <code><?php echo htmlspecialchars("<?php echo ggd_app_link('mygrows', 'View My Grows'); ?>"); ?></code>
            </div>
            
            <div class="ggd-example">
                <h3>PHP Function: Direct Redirect</h3>
                <p>Redirect immediately to the app:</p>
                <code><?php echo htmlspecialchars("<?php ggd_redirect_to_app('tools/calculator'); ?>"); ?></code>
            </div>
        </div>
    </div>
    
    <hr>
    
    <div class="ggd-admin-section">
        <h2>App Paths</h2>
        <p>The following paths will automatically trigger app redirection when accessed:</p>
        
        <div class="ggd-paths-grid">
            <?php 
            $app_paths = $this->get_app_paths();
            foreach ($app_paths as $path): 
            ?>
                <div class="ggd-path-item">
                    <code>yoursite.com/<?php echo esc_html($path); ?>/...</code>
                </div>
            <?php endforeach; ?>
        </div>
        
        <p class="description">
            These paths can be customized using the <code>ggd_app_paths</code> filter in your theme.
        </p>
    </div>
    
    <hr>
    
    <div class="ggd-admin-section">
        <h2>Statistics</h2>
        
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'ggd_interactions';
        
        // Check if table exists
        $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;
        
        if ($table_exists):
            $total_interactions = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
            $app_opens = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE type IN ('app_opened', 'app_potentially_opened')");
            $store_clicks = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE type = 'store_click'");
            $recent_interactions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY timestamp DESC LIMIT 10");
        ?>
            
            <div class="ggd-stats-grid">
                <div class="ggd-stat-card">
                    <div class="ggd-stat-number"><?php echo number_format($total_interactions); ?></div>
                    <div class="ggd-stat-label">Total Interactions</div>
                </div>
                
                <div class="ggd-stat-card">
                    <div class="ggd-stat-number"><?php echo number_format($app_opens); ?></div>
                    <div class="ggd-stat-label">App Opens</div>
                </div>
                
                <div class="ggd-stat-card">
                    <div class="ggd-stat-number"><?php echo number_format($store_clicks); ?></div>
                    <div class="ggd-stat-label">Store Clicks</div>
                </div>
                
                <div class="ggd-stat-card">
                    <div class="ggd-stat-number">
                        <?php echo $total_interactions > 0 ? round(($app_opens / $total_interactions) * 100, 1) . '%' : '0%'; ?>
                    </div>
                    <div class="ggd-stat-label">Success Rate</div>
                </div>
            </div>
            
            <?php if (!empty($recent_interactions)): ?>
                <h3>Recent Activity</h3>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Path</th>
                            <th>Date</th>
                            <th>User Agent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_interactions as $interaction): ?>
                            <tr>
                                <td><?php echo esc_html($interaction->type); ?></td>
                                <td><code><?php echo esc_html($interaction->path); ?></code></td>
                                <td><?php echo esc_html(human_time_diff(strtotime($interaction->timestamp))); ?> ago</td>
                                <td><?php echo esc_html(wp_trim_words($interaction->user_agent, 8)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
        <?php else: ?>
            <p>Statistics table not found. Try deactivating and reactivating the plugin.</p>
        <?php endif; ?>
    </div>
</div>

<style>
.ggd-admin-section {
    margin: 32px 0;
}

.ggd-usage-examples {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.ggd-example {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #4CAF50;
}

.ggd-example h3 {
    margin-top: 0;
    color: #333;
}

.ggd-example code {
    display: block;
    background: #fff;
    padding: 10px;
    border-radius: 4px;
    margin-top: 10px;
    word-break: break-all;
}

.ggd-paths-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    margin: 20px 0;
}

.ggd-path-item {
    background: #f0f0f0;
    padding: 12px;
    border-radius: 6px;
    text-align: center;
}

.ggd-path-item code {
    color: #4CAF50;
    font-weight: 600;
}

.ggd-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.ggd-stat-card {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 24px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.ggd-stat-number {
    font-size: 32px;
    font-weight: bold;
    color: #4CAF50;
    line-height: 1;
}

.ggd-stat-label {
    margin-top: 8px;
    color: #666;
    font-size: 14px;
}

@media (max-width: 782px) {
    .ggd-usage-examples,
    .ggd-paths-grid,
    .ggd-stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
