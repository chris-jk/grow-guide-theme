<?php
/*
Template Name: Pro Members
*/
get_header(); ?>

<div class="pro-container">
    <div class="pro-hero">
        <h1>Grow Guide Pro</h1>
        <p>Unlock the full potential of your cultivation with advanced features and expert support</p>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="pro-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>

    <!-- Default pro content -->
    <div class="pro-features-section">
        <h2>Pro Features</h2>
        
        <div class="features-comparison">
            <div class="comparison-table">
                <div class="comparison-header">
                    <div class="feature-column">Features</div>
                    <div class="free-column">Free</div>
                    <div class="pro-column">Pro</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">Plant Tracking</div>
                    <div class="free-value">Up to 3 plants</div>
                    <div class="pro-value">Unlimited plants</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">AI Recommendations</div>
                    <div class="free-value">Basic insights</div>
                    <div class="pro-value">Advanced AI analysis</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">Data Export</div>
                    <div class="free-value">Limited</div>
                    <div class="pro-value">Full data export</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">Cloud Backup</div>
                    <div class="free-value">✗</div>
                    <div class="pro-value">✓</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">Expert Support</div>
                    <div class="free-value">Community only</div>
                    <div class="pro-value">Direct expert access</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">Advanced Analytics</div>
                    <div class="free-value">✗</div>
                    <div class="pro-value">✓</div>
                </div>
                
                <div class="comparison-row">
                    <div class="feature-name">Custom Reminders</div>
                    <div class="free-value">Basic</div>
                    <div class="pro-value">Advanced scheduling</div>
                </div>
            </div>
        </div>
    </div>

    <div class="pro-benefits">
        <h2>Why Go Pro?</h2>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-infinity"></i>
                </div>
                <h3>Unlimited Tracking</h3>
                <p>Track as many plants as you want with detailed logs and photo documentation for each one.</p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <h3>Advanced AI</h3>
                <p>Get personalized recommendations based on your specific growing conditions and plant varieties.</p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h3>Cloud Backup</h3>
                <p>Never lose your growing data with automatic cloud backup and sync across devices.</p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Expert Support</h3>
                <p>Get direct access to experienced growers and cultivation experts for personalized advice.</p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Advanced Analytics</h3>
                <p>Detailed insights into your growing patterns, yield optimization, and performance metrics.</p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-download"></i>
                </div>
                <h3>Data Export</h3>
                <p>Export all your growing data in various formats for your own analysis and record keeping.</p>
            </div>
        </div>
    </div>

    <div class="pricing-section">
        <h2>Choose Your Plan</h2>
        
        <div class="pricing-cards">
            <div class="pricing-card">
                <h3>Monthly</h3>
                <div class="price">
                    <span class="currency">$</span>
                    <span class="amount">9.99</span>
                    <span class="period">/month</span>
                </div>
                <ul class="plan-features">
                    <li>All Pro features</li>
                    <li>Cancel anytime</li>
                    <li>Priority support</li>
                </ul>
                <a href="#" class="btn btn-primary">Start Free Trial</a>
            </div>

            <div class="pricing-card featured">
                <div class="popular-badge">Most Popular</div>
                <h3>Annual</h3>
                <div class="price">
                    <span class="currency">$</span>
                    <span class="amount">79.99</span>
                    <span class="period">/year</span>
                </div>
                <div class="savings">Save 33%</div>
                <ul class="plan-features">
                    <li>All Pro features</li>
                    <li>2 months free</li>
                    <li>Priority support</li>
                    <li>Exclusive content</li>
                </ul>
                <a href="#" class="btn btn-primary">Start Free Trial</a>
            </div>
        </div>
        
        <p class="trial-info">7-day free trial • Cancel anytime • No commitment</p>
    </div>

    <div class="testimonials-section">
        <h2>What Pro Users Say</h2>
        
        <div class="pro-testimonials">
            <div class="testimonial">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>"The expert support alone is worth the Pro subscription. I've learned more in 3 months than I did in years of growing on my own."</p>
                <div class="testimonial-author">
                    <strong>Sarah M.</strong>
                    <span>Pro Member since 2024</span>
                </div>
            </div>

            <div class="testimonial">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>"The advanced analytics helped me optimize my setup and increase my yields by 40%. The data export feature is incredible for tracking long-term progress."</p>
                <div class="testimonial-author">
                    <strong>Mike R.</strong>
                    <span>Pro Member since 2023</span>
                </div>
            </div>
        </div>
    </div>

    <div class="faq-section">
        <h2>Frequently Asked Questions</h2>
        
        <div class="faq-item">
            <h3>Can I cancel my subscription anytime?</h3>
            <p>Yes, you can cancel your Pro subscription at any time. You'll continue to have access to Pro features until the end of your billing period.</p>
        </div>

        <div class="faq-item">
            <h3>What happens to my data if I cancel?</h3>
            <p>Your data remains safe and accessible. You'll just lose access to Pro features but can still use the free version of the app.</p>
        </div>

        <div class="faq-item">
            <h3>Do you offer student discounts?</h3>
            <p>Yes! We offer a 50% discount for students. Contact our support team with your student verification.</p>
        </div>

        <div class="faq-item">
            <h3>Can I upgrade from monthly to annual?</h3>
            <p>Absolutely! You can change your subscription plan at any time from within the app settings.</p>
        </div>
    </div>
</div>


<?php get_footer(); ?>
