<?php
/*
Template Name: Privacy Policy
*/
get_header(); ?>

<div class="legal-container">
    <div class="legal-hero">
        <h1>Privacy Policy</h1>
        <p>Your privacy is important to us. Learn how we collect, use, and protect your information.</p>
    </div>

    <div class="legal-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

        <!-- Default privacy policy content -->
        <?php if (!have_posts() || !get_the_content()): ?>
            <section class="legal-section">
                <h2>Information We Collect</h2>
                <p>We collect information you provide directly to us, such as when you create an account, use our services, or contact us for support.</p>
                
                <h3>Personal Information</h3>
                <ul>
                    <li>Account information (username, email address)</li>
                    <li>Profile information you choose to provide</li>
                    <li>Communications with us</li>
                    <li>Growing data and logs you create in the app</li>
                </ul>

                <h3>Automatically Collected Information</h3>
                <ul>
                    <li>Device information and identifiers</li>
                    <li>Usage data and analytics</li>
                    <li>Location data (if you grant permission)</li>
                    <li>Crash reports and performance data</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>How We Use Your Information</h2>
                <p>We use the information we collect to provide, maintain, and improve our services.</p>
                
                <ul>
                    <li>Provide and operate the Grow Guide app</li>
                    <li>Personalize your experience and recommendations</li>
                    <li>Communicate with you about our services</li>
                    <li>Analyze usage patterns to improve our app</li>
                    <li>Ensure security and prevent fraud</li>
                    <li>Comply with legal obligations</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Information Sharing</h2>
                <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described below:</p>
                
                <ul>
                    <li><strong>Service Providers:</strong> We may share information with trusted service providers who assist us in operating our app</li>
                    <li><strong>Legal Requirements:</strong> We may disclose information when required by law or to protect our rights</li>
                    <li><strong>Business Transfers:</strong> Information may be transferred in connection with a merger or acquisition</li>
                    <li><strong>Consent:</strong> We may share information with your explicit consent</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Data Security</h2>
                <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>
                
                <ul>
                    <li>Encryption of data in transit and at rest</li>
                    <li>Regular security audits and updates</li>
                    <li>Access controls and authentication</li>
                    <li>Secure data centers and infrastructure</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Your Rights</h2>
                <p>You have certain rights regarding your personal information:</p>
                
                <ul>
                    <li><strong>Access:</strong> Request access to your personal information</li>
                    <li><strong>Correction:</strong> Request correction of inaccurate information</li>
                    <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                    <li><strong>Portability:</strong> Request a copy of your data in a portable format</li>
                    <li><strong>Opt-out:</strong> Opt out of certain communications</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Contact Us</h2>
                <p>If you have questions about this Privacy Policy, please contact us:</p>
                
                <div class="contact-info">
                    <p><strong>Email:</strong> privacy@growguide.app</p>
                    <p><strong>Address:</strong> [Your Company Address]</p>
                </div>
            </section>

            <section class="legal-section">
                <h2>Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date.</p>
                
                <p><strong>Last Updated:</strong> <?php echo date('F j, Y'); ?></p>
            </section>
        <?php endif; ?>
    </div>
</div>

<style>
.legal-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    padding-top: 100px;
}

.legal-hero {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--card-bg);
    border-radius: 20px;
    margin-bottom: 3rem;
    backdrop-filter: blur(10px);
}

.legal-hero h1 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.legal-content {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.legal-section {
    margin-bottom: 3rem;
}

.legal-section h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 0.5rem;
}

.legal-section h3 {
    color: var(--primary-light);
    margin: 1.5rem 0 1rem 0;
}

.legal-section ul {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.legal-section li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.contact-info {
    background: rgba(76, 175, 80, 0.1);
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid var(--primary-color);
}

.contact-info p {
    margin-bottom: 0.5rem;
}
</style>

<?php get_footer(); ?>
