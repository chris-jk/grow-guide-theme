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

<style>
.pro-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.pro-hero {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: 20px;
    margin-bottom: 4rem;
}

.pro-hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.pro-features-section,
.pro-benefits,
.pricing-section,
.testimonials-section,
.faq-section {
    margin-bottom: 4rem;
}

.pro-features-section h2,
.pro-benefits h2,
.pricing-section h2,
.testimonials-section h2,
.faq-section h2 {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 2rem;
}

.comparison-table {
    background: var(--card-bg);
    border-radius: 15px;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.comparison-header,
.comparison-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    align-items: center;
}

.comparison-header {
    background: var(--primary-color);
    color: white;
    font-weight: 600;
    padding: 1rem;
}

.comparison-row {
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.comparison-row:last-child {
    border-bottom: none;
}

.pro-value {
    color: var(--primary-color);
    font-weight: 600;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.benefit-card {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    backdrop-filter: blur(10px);
    transition: var(--transition);
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(76, 175, 80, 0.2);
}

.benefit-icon {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.benefit-card h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.pricing-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.pricing-card {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 20px;
    text-align: center;
    backdrop-filter: blur(10px);
    position: relative;
    transition: var(--transition);
}

.pricing-card.featured {
    border: 2px solid var(--primary-color);
    transform: scale(1.05);
}

.popular-badge {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.price {
    margin: 1rem 0;
}

.currency {
    font-size: 1.5rem;
    vertical-align: top;
}

.amount {
    font-size: 3rem;
    font-weight: bold;
    color: var(--primary-color);
}

.period {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.7);
}

.savings {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1rem;
}

.plan-features {
    list-style: none;
    margin: 2rem 0;
}

.plan-features li {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.plan-features li:last-child {
    border-bottom: none;
}

.trial-info {
    text-align: center;
    margin-top: 2rem;
    color: rgba(255, 255, 255, 0.7);
}

.pro-testimonials {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.testimonial {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.stars {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.testimonial-author {
    margin-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 1rem;
}

.testimonial-author span {
    display: block;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.faq-item {
    background: var(--card-bg);
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    backdrop-filter: blur(10px);
}

.faq-item h3 {
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .comparison-header,
    .comparison-row {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .pricing-card.featured {
        transform: none;
    }
    
    .pro-testimonials {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
