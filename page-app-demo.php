<?php
/*
Template Name: App Director Demo
*/

get_header(); ?>

<div class="page-container">
    <div class="content-section">
        <header class="page-header">
            <h1>Grow Guide Director Plugin Demo</h1>
            <p class="page-description">
                This page demonstrates the various features of the Grow Guide Director plugin for smart app redirection.
            </p>
        </header>

        <div class="demo-sections">
            
            <!-- App Link Examples -->
            <section class="demo-section">
                <h2>App Link Buttons</h2>
                <p>These buttons attempt to open specific sections of the Grow Guide mobile app:</p>
                
                <div class="app-links-grid">
                    <div class="app-link-demo">
                        <h3>User Profile</h3>
                        <?php echo do_shortcode('[app_link path="user/profile" text="Open Profile" class="btn btn-primary"]'); ?>
                    </div>
                    
                    <div class="app-link-demo">
                        <h3>My Grows</h3>
                        <?php echo do_shortcode('[app_link path="mygrows" text="View My Grows" class="btn btn-success"]'); ?>
                    </div>
                    
                    <div class="app-link-demo">
                        <h3>Tools & Calculator</h3>
                        <?php echo do_shortcode('[app_link path="tools/calculator" text="Open Calculator" class="btn btn-info"]'); ?>
                    </div>
                    
                    <div class="app-link-demo">
                        <h3>Q&A Section</h3>
                        <?php echo do_shortcode('[app_link path="questions" text="Browse Questions" class="btn btn-warning"]'); ?>
                    </div>
                </div>
            </section>

            <!-- Smart Redirect Demo -->
            <section class="demo-section">
                <h2>Smart Redirect</h2>
                <p>This section will automatically redirect to the app after a delay:</p>
                
                <div class="redirect-demo">
                    <h3>Auto-Redirect to Help Section</h3>
                    <?php echo do_shortcode('[smart_redirect path="help" delay="3000" message="Redirecting to help section..."]'); ?>
                    <p><small>Note: This will attempt to redirect to the app in 3 seconds.</small></p>
                </div>
            </section>

            <!-- Manual Testing Section -->
            <section class="demo-section">
                <h2>Manual Testing</h2>
                <p>Use these links to manually test different app paths:</p>
                
                <div class="manual-test-links">
                    <ul>
                        <li><a href="<?php echo home_url('/user/settings'); ?>">yoursite.com/user/settings</a> - User settings page</li>
                        <li><a href="<?php echo home_url('/post/123'); ?>">yoursite.com/post/123</a> - Specific post</li>
                        <li><a href="<?php echo home_url('/grow/indoor-setup'); ?>">yoursite.com/grow/indoor-setup</a> - Grow guide</li>
                        <li><a href="<?php echo home_url('/tools/nutrient-calculator'); ?>">yoursite.com/tools/nutrient-calculator</a> - Tool page</li>
                    </ul>
                </div>
            </section>

            <!-- JavaScript Integration -->
            <section class="demo-section">
                <h2>JavaScript Integration</h2>
                <p>Test the plugin's JavaScript functions:</p>
                
                <div class="js-demo-buttons">
                    <button onclick="window.ggdShowAppPrompt()" class="btn btn-secondary">
                        Show App Download Prompt
                    </button>
                    
                    <button onclick="window.ggdOpenApp('admin/dashboard')" class="btn btn-dark">
                        Open Admin Dashboard
                    </button>
                </div>
            </section>

            <!-- Features Overview -->
            <section class="demo-section">
                <h2>Plugin Features</h2>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>🔗 Smart Deep Linking</h3>
                        <p>Automatically detects device type and attempts to open the app with the correct deep link format.</p>
                    </div>
                    
                    <div class="feature-card">
                        <h3>📱 Mobile-First</h3>
                        <p>Optimized for mobile devices with iOS and Android specific handling and fallbacks.</p>
                    </div>
                    
                    <div class="feature-card">
                        <h3>💻 Desktop Support</h3>
                        <p>Shows QR codes and download links for desktop users to access content on mobile.</p>
                    </div>
                    
                    <div class="feature-card">
                        <h3>📊 Analytics</h3>
                        <p>Built-in tracking for app opens, store clicks, and user interactions.</p>
                    </div>
                    
                    <div class="feature-card">
                        <h3>🎨 Customizable</h3>
                        <p>Flexible styling options and behavior settings to match your brand.</p>
                    </div>
                    
                    <div class="feature-card">
                        <h3>⚡ Performance</h3>
                        <p>Lightweight and optimized for fast loading and smooth user experience.</p>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<style>
.demo-sections {
    max-width: 1000px;
    margin: 0 auto;
}

.demo-section {
    margin: 48px 0;
    padding: 32px;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 4px solid #4CAF50;
}

.demo-section h2 {
    color: #2c3e50;
    margin-bottom: 16px;
}

.app-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin: 24px 0;
}

.app-link-demo {
    background: white;
    padding: 24px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.app-link-demo h3 {
    margin: 0 0 16px;
    color: #495057;
}

.redirect-demo {
    background: white;
    padding: 24px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.manual-test-links ul {
    background: white;
    padding: 24px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.manual-test-links li {
    margin: 12px 0;
}

.manual-test-links a {
    color: #4CAF50;
    text-decoration: none;
    font-family: monospace;
    font-size: 14px;
}

.manual-test-links a:hover {
    text-decoration: underline;
}

.js-demo-buttons {
    text-align: center;
    padding: 24px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.js-demo-buttons button {
    margin: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-dark {
    background: #343a40;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

.btn-dark:hover {
    background: #23272b;
    transform: translateY(-1px);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin: 24px 0;
}

.feature-card {
    background: white;
    padding: 24px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.feature-card h3 {
    margin: 0 0 12px;
    color: #2c3e50;
    font-size: 18px;
}

.feature-card p {
    margin: 0;
    color: #6c757d;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .demo-section {
        padding: 20px;
        margin: 32px 0;
    }
    
    .app-links-grid,
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .js-demo-buttons button {
        display: block;
        width: 100%;
        margin: 8px 0;
    }
}

/* Dark theme support */
@media (prefers-color-scheme: dark) {
    .demo-section {
        background: #2a2a2a;
        color: #e0e0e0;
    }
    
    .demo-section h2 {
        color: #e0e0e0;
    }
    
    .app-link-demo,
    .redirect-demo,
    .manual-test-links ul,
    .js-demo-buttons,
    .feature-card {
        background: #333;
        color: #e0e0e0;
    }
    
    .app-link-demo h3,
    .feature-card h3 {
        color: #e0e0e0;
    }
    
    .feature-card p {
        color: #ccc;
    }
}
</style>

<?php get_footer(); ?>
