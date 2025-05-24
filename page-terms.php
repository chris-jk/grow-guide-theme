<?php
/*
Template Name: Terms of Service
*/
get_header(); ?>

<div class="legal-container">
    <div class="legal-hero">
        <h1>Terms of Service</h1>
        <p>Please read these terms carefully before using the Grow Guide app and services.</p>
    </div>

    <div class="legal-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

        <!-- Default terms of service content -->
        <?php if (!have_posts() || !get_the_content()): ?>
            <section class="legal-section">
                <h2>Acceptance of Terms</h2>
                <p>By accessing and using the Grow Guide app and services, you accept and agree to be bound by the terms and provision of this agreement.</p>
            </section>

            <section class="legal-section">
                <h2>Description of Service</h2>
                <p>Grow Guide is a mobile application and web service that provides:</p>
                
                <ul>
                    <li>Plant tracking and cultivation management tools</li>
                    <li>Community features for grower interaction</li>
                    <li>AI-powered recommendations and insights</li>
                    <li>Educational content and resources</li>
                    <li>Analytics and progress tracking</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>User Accounts</h2>
                <p>To access certain features of our service, you may be required to create an account. You agree to:</p>
                
                <ul>
                    <li>Provide accurate and complete registration information</li>
                    <li>Maintain the security of your account credentials</li>
                    <li>Notify us immediately of any unauthorized use</li>
                    <li>Accept responsibility for all activities under your account</li>
                    <li>Use the service only for lawful purposes</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Acceptable Use</h2>
                <p>You agree not to use the service to:</p>
                
                <ul>
                    <li>Violate any applicable laws or regulations</li>
                    <li>Infringe on intellectual property rights</li>
                    <li>Transmit harmful or malicious content</li>
                    <li>Interfere with the operation of the service</li>
                    <li>Attempt to gain unauthorized access to our systems</li>
                    <li>Use the service for any illegal cultivation activities</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Legal Compliance</h2>
                <p><strong>Important:</strong> Users are solely responsible for ensuring their cultivation activities comply with all applicable local, state, and federal laws. Grow Guide does not provide legal advice and does not endorse any illegal activities.</p>
                
                <ul>
                    <li>Check your local laws before beginning any cultivation</li>
                    <li>Obtain necessary licenses and permits</li>
                    <li>Follow all regulations regarding cultivation limits</li>
                    <li>Ensure compliance with zoning laws</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Content and Intellectual Property</h2>
                <p>The service and its original content, features, and functionality are owned by Grow Guide and are protected by copyright, trademark, and other intellectual property laws.</p>
                
                <h3>User-Generated Content</h3>
                <ul>
                    <li>You retain ownership of content you create and share</li>
                    <li>You grant us a license to use your content to provide the service</li>
                    <li>You are responsible for the content you share</li>
                    <li>We may remove content that violates these terms</li>
                </ul>
            </section>

            <section class="legal-section">
                <h2>Privacy</h2>
                <p>Your privacy is important to us. Please review our Privacy Policy, which also governs your use of the service, to understand our practices.</p>
            </section>

            <section class="legal-section">
                <h2>Disclaimers</h2>
                <p>The service is provided "as is" without warranties of any kind. We disclaim all warranties, whether express or implied, including:</p>
                
                <ul>
                    <li>Warranties of merchantability and fitness for a particular purpose</li>
                    <li>Warranties regarding the accuracy or reliability of content</li>
                    <li>Warranties that the service will be uninterrupted or error-free</li>
                </ul>
                
                <p><strong>Growing Disclaimer:</strong> Cultivation success depends on many factors beyond our control. We do not guarantee specific results from using our recommendations or tools.</p>
            </section>

            <section class="legal-section">
                <h2>Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, Grow Guide shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.</p>
            </section>

            <section class="legal-section">
                <h2>Termination</h2>
                <p>We may terminate or suspend your access to the service immediately, without prior notice, for any reason, including if you breach these terms.</p>
                
                <p>Upon termination, your right to use the service will cease immediately, but provisions that should survive termination will remain in effect.</p>
            </section>

            <section class="legal-section">
                <h2>Changes to Terms</h2>
                <p>We reserve the right to modify these terms at any time. We will notify users of any changes by posting the new terms on this page and updating the "Last Updated" date.</p>
                
                <p>Your continued use of the service after changes constitutes acceptance of the new terms.</p>
            </section>

            <section class="legal-section">
                <h2>Governing Law</h2>
                <p>These terms shall be governed by and construed in accordance with the laws of [Your Jurisdiction], without regard to its conflict of law provisions.</p>
            </section>

            <section class="legal-section">
                <h2>Contact Information</h2>
                <p>If you have any questions about these Terms of Service, please contact us:</p>
                
                <div class="contact-info">
                    <p><strong>Email:</strong> legal@growguide.app</p>
                    <p><strong>Address:</strong> [Your Company Address]</p>
                </div>
                
                <p><strong>Last Updated:</strong> <?php echo date('F j, Y'); ?></p>
            </section>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>
