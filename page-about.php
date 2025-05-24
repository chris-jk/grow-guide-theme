<?php
/*
Template Name: About Page
*/
get_header(); ?>

<div class="about-container">
    <div class="about-hero">
        <h1>About Grow Guide</h1>
        <p>Empowering growers with technology and community</p>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="about-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>

    <!-- Default content if no page content exists -->
    <?php if (!have_posts() || !get_the_content()): ?>
        <div class="about-content">
            <div class="about-section">
                <h2>Our Mission</h2>
                <p>
                    At Grow Guide, we believe that successful cultivation should be accessible to everyone. 
                    Our mission is to democratize growing knowledge by combining cutting-edge technology 
                    with the wisdom of experienced cultivators.
                </p>
            </div>

            <div class="about-section">
                <h2>What We Do</h2>
                <p>
                    We've created a comprehensive platform that serves as your personal growing assistant. 
                    From tracking your plants' progress to connecting you with a community of expert growers, 
                    Grow Guide is designed to help you achieve the best possible results.
                </p>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>We continuously innovate to bring you the latest in growing technology and AI-powered insights.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>We foster a supportive community where growers of all levels can learn and share experiences.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Results</h3>
                    <p>We're committed to helping you achieve measurable improvements in your growing success.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Trust</h3>
                    <p>We prioritize your privacy and data security while providing reliable, accurate information.</p>
                </div>
            </div>

            <div class="about-section">
                <h2>Our Team</h2>
                <p>
                    Our team combines decades of growing experience with expertise in mobile development, 
                    AI, and data science. We're passionate growers ourselves, and we understand the challenges 
                    and rewards of cultivation.
                </p>
            </div>

            <div class="about-section">
                <h2>Join Our Community</h2>
                <p>
                    Ready to take your growing to the next level? Download Grow Guide today and join 
                    thousands of successful growers who trust our platform for their cultivation journey.
                </p>
                
                <?php get_template_part('template-parts/store-badges'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
