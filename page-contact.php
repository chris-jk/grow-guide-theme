<?php
/*
Template Name: Contact Page
*/
get_header(); ?>

<div class="contact-container">
    <div class="contact-hero">
        <h1>Get in Touch</h1>
        <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="contact-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>

    <!-- Default contact content -->
    <div class="contact-grid">
        <div class="contact-info">
            <h2>Contact Information</h2>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-details">
                    <h3>Email</h3>
                    <p>support@growguide.app</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="contact-details">
                    <h3>Download Our App</h3>
                    <p>Get support directly through the app</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="contact-details">
                    <h3>Community</h3>
                    <p>Join our growing community for peer support</p>
                </div>
            </div>

            <div class="social-links">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>
            
            <?php echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]'); ?>
            
            <!-- Fallback form if Contact Form 7 is not installed -->
            <form id="contact-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                <input type="hidden" name="action" value="grow_guide_contact">
                <?php wp_nonce_field('grow_guide_contact_nonce', 'contact_nonce'); ?>
                
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject">
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>

                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </div>

    <div class="download-section">
        <h2>Download Our App</h2>
        <p>For the fastest support, download our app and use the in-app help feature.</p>
        
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

<style>
.contact-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.contact-hero {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url("https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d") center/cover;
    color: white;
    border-radius: 20px;
    margin: 0 0 3rem 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 2rem;
    margin-top: 3rem;
}

.contact-info,
.contact-form {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
}

.contact-icon {
    background: var(--primary-color);
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
}

.contact-details h3 {
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

.social-icons {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.social-icons a {
    background: var(--primary-color);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.social-icons a:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--primary-color);
    font-weight: 500;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--text-color);
    font-family: inherit;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary-color);
}

.download-section {
    text-align: center;
    margin-top: 3rem;
    padding: 2rem;
    background: var(--card-bg);
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.store-badges {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.store-badge {
    height: 60px;
    transition: var(--transition);
}

.store-badge:hover {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
    
    .store-badges {
        flex-direction: column;
        align-items: center;
    }
}
</style>

<?php get_footer(); ?>
