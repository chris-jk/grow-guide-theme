<?php
/*
Template Name: Learn to Grow Page
*/
get_header(); ?>

<div class="learn-container">
    <div class="learn-hero">
        <h1>Learn How to Grow</h1>
        <p>Master the art of cultivation with expert guidance and proven techniques</p>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="learn-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>

    <!-- Default learning content -->
    <div class="content">
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3>Getting Started</h3>
                <p>Learn the fundamentals of cultivation, from choosing the right environment to understanding plant biology.</p>
                <a href="#getting-started" class="learn-more">Learn More</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <h3>Watering & Nutrients</h3>
                <p>Master the art of proper watering schedules and nutrient management for optimal plant health.</p>
                <a href="#watering" class="learn-more">Learn More</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3>Lighting Systems</h3>
                <p>Understand different lighting options and how to optimize light cycles for maximum yields.</p>
                <a href="#lighting" class="learn-more">Learn More</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-thermometer-half"></i>
                </div>
                <h3>Climate Control</h3>
                <p>Learn how to maintain ideal temperature and humidity levels throughout the growing cycle.</p>
                <a href="#climate" class="learn-more">Learn More</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bug"></i>
                </div>
                <h3>Pest Management</h3>
                <p>Identify common pests and diseases, and learn organic prevention and treatment methods.</p>
                <a href="#pests" class="learn-more">Learn More</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cut"></i>
                </div>
                <h3>Harvesting</h3>
                <p>Know when and how to harvest for peak potency and quality, plus proper curing techniques.</p>
                <a href="#harvesting" class="learn-more">Learn More</a>
            </div>
        </div>

        <div class="learning-sections">
            <section id="getting-started" class="learning-section">
                <h2>Getting Started</h2>
                <div class="section-content">
                    <h3>Choose Your Growing Method</h3>
                    <ul>
                        <li><strong>Soil Growing:</strong> Traditional method using high-quality potting soil</li>
                        <li><strong>Hydroponic:</strong> Soilless growing using nutrient solutions</li>
                        <li><strong>Coco Coir:</strong> Growing in coconut fiber for better drainage</li>
                    </ul>

                    <h3>Essential Equipment</h3>
                    <ul>
                        <li>Growing containers or pots</li>
                        <li>Quality growing medium</li>
                        <li>Lighting system (LED recommended)</li>
                        <li>Ventilation fans</li>
                        <li>pH and TDS meters</li>
                        <li>Thermometer and hygrometer</li>
                    </ul>
                </div>
            </section>

            <section id="watering" class="learning-section">
                <h2>Watering & Nutrients</h2>
                <div class="section-content">
                    <h3>Watering Guidelines</h3>
                    <ul>
                        <li>Water when the top inch of soil feels dry</li>
                        <li>Ensure proper drainage to prevent root rot</li>
                        <li>Use pH-balanced water (6.0-7.0 for soil, 5.5-6.5 for hydro)</li>
                        <li>Water slowly and evenly</li>
                    </ul>

                    <h3>Nutrient Management</h3>
                    <ul>
                        <li>Use quality nutrients designed for your growing medium</li>
                        <li>Follow manufacturer's feeding schedules</li>
                        <li>Monitor plant response and adjust accordingly</li>
                        <li>Flush with plain water periodically</li>
                    </ul>
                </div>
            </section>

            <section id="lighting" class="learning-section">
                <h2>Lighting Systems</h2>
                <div class="section-content">
                    <h3>Light Types</h3>
                    <ul>
                        <li><strong>LED:</strong> Energy efficient, low heat, full spectrum</li>
                        <li><strong>HPS:</strong> High intensity, good for flowering</li>
                        <li><strong>MH:</strong> Great for vegetative growth</li>
                        <li><strong>CFL:</strong> Good for small grows and seedlings</li>
                    </ul>

                    <h3>Light Cycles</h3>
                    <ul>
                        <li><strong>Vegetative:</strong> 18-24 hours of light daily</li>
                        <li><strong>Flowering:</strong> 12 hours light, 12 hours dark</li>
                        <li>Maintain consistent schedules</li>
                        <li>Use timers for automation</li>
                    </ul>
                </div>
            </section>
        </div>

        <div class="app-promotion">
            <h2>Track Your Learning Journey</h2>
            <p>Download Grow Guide to track your progress, get personalized recommendations, and connect with expert growers.</p>
            
            <div class="store-badges">
                <a href="<?php echo get_theme_mod('app_store_url', 'https://apps.apple.com/us/app/grow-guide/id6637720578'); ?>" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/appstore.svg" alt="Download on App Store" class="store-badge" />
                </a>
                <a href="<?php echo get_theme_mod('google_play_url', 'https://play.google.com/store/apps/details?id=app.growguide'); ?>" target="_blank" rel="noopener">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/playstore.png" alt="Get it on Google Play" class="store-badge" />
                </a>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
