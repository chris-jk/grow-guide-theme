<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opening Grow Guide App...</title>
    
    <!-- Prevent indexing of redirect pages -->
    <meta name="robots" content="noindex, nofollow">
    
    <!-- App redirect meta tags -->
    <meta property="al:ios:url" content="<?php echo esc_attr($deep_link); ?>">
    <meta property="al:ios:app_store_id" content="6637720578">
    <meta property="al:ios:app_name" content="Grow Guide">
    
    <meta property="al:android:url" content="<?php echo esc_attr($deep_link); ?>">
    <meta property="al:android:package" content="app.growguide">
    <meta property="al:android:app_name" content="Grow Guide">
    
    <!-- Twitter App Card -->
    <meta name="twitter:card" content="app">
    <meta name="twitter:app:name:iphone" content="Grow Guide">
    <meta name="twitter:app:id:iphone" content="6637720578">
    <meta name="twitter:app:url:iphone" content="<?php echo esc_attr($deep_link); ?>">
    <meta name="twitter:app:name:googleplay" content="Grow Guide">
    <meta name="twitter:app:id:googleplay" content="app.growguide">
    <meta name="twitter:app:url:googleplay" content="<?php echo esc_attr($deep_link); ?>">
    
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .redirect-container {
            max-width: 500px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .app-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 18px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #4CAF50;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 24px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        h1 {
            margin: 0 0 16px;
            font-size: 28px;
            font-weight: 600;
        }
        
        p {
            margin: 0 0 24px;
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.5;
        }
        
        .fallback-section {
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .store-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .store-badge {
            display: inline-block;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .store-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .store-badge img {
            height: 48px;
            width: auto;
            display: block;
        }
        
        .continue-web {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 16px;
            transition: all 0.3s ease;
        }
        
        .continue-web:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        @media (max-width: 600px) {
            .redirect-container {
                margin: 20px;
                padding: 30px 20px;
            }
            
            .store-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="redirect-container">
        <div class="app-icon">🌱</div>
        
        <h1>Opening Grow Guide App...</h1>
        <p>You're being redirected to the Grow Guide mobile app for the best experience.</p>
        
        <div class="spinner"></div>
        
        <div class="fallback-section">
            <p>App not opening? Download it now:</p>
            
            <div class="store-buttons">
                <a href="<?php echo esc_url($config['app_store_url']); ?>" class="store-badge" target="_blank">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiByeD0iNSIgZmlsbD0iIzAwMCIvPgo8dGV4dCB4PSIyMCIgeT0iMTQiIGZpbGw9IndoaXRlIiBmb250LXNpemU9IjEwIiBmb250LWZhbWlseT0iQXJpYWwiPkRvd25sb2FkIG9uIHRoZTwvdGV4dD4KPHRleHQgeD0iMjAiIHk9IjI4IiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtZmFtaWx5PSJBcmlhbCI+QXBwIFN0b3JlPC90ZXh0Pgo8L3N2Zz4K" alt="Download on App Store">
                </a>
                
                <a href="<?php echo esc_url($config['play_store_url']); ?>" class="store-badge" target="_blank">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgMTIwIDQwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cmVjdCB3aWR0aD0iMTIwIiBoZWlnaHQ9IjQwIiByeD0iNSIgZmlsbD0iIzAwMCIvPgo8dGV4dCB4PSIyMCIgeT0iMTQiIGZpbGw9IndoaXRlIiBmb250LXNpemU9IjEwIiBmb250LWZhbWlseT0iQXJpYWwiPkdldCBpdCBvbjwvdGV4dD4KPHRleHQgeD0iMjAiIHk9IjI4IiBmaWxsPSJ3aGl0ZSIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZvbnQtZmFtaWx5PSJBcmlhbCI+R29vZ2xlIFBsYXk8L3RleHQ+Cjwvc3ZnPgo=" alt="Get it on Google Play">
                </a>
            </div>
            
            <a href="<?php echo esc_url($fallback_url); ?>" class="continue-web">Continue on Web</a>
        </div>
    </div>
    
    <script>
        // Immediate app redirection attempt
        window.addEventListener('load', function() {
            // Try to open the app
            window.location.href = '<?php echo esc_js($deep_link); ?>';
            
            // Fallback behavior
            setTimeout(function() {
                if (document.hasFocus()) {
                    // App didn't open, show instructions
                    console.log('App redirection may have failed, showing fallback options');
                }
            }, 2000);
        });
        
        // Track that this redirect page was shown
        if (typeof ggdConfig !== 'undefined' && ggdConfig.ajax_url) {
            fetch(ggdConfig.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'ggd_track_interaction',
                    nonce: ggdConfig.nonce || '',
                    type: 'redirect_page_shown',
                    path: '<?php echo esc_js($full_path); ?>'
                })
            });
        }
    </script>
</body>
</html>
