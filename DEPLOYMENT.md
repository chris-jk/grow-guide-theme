# Grow Guide WordPress Theme - Deployment Guide

## Production Deployment Checklist

### Pre-Deployment Preparation

#### 1. Theme Package Preparation

```bash
# Create a clean theme package
cd /wp-content/themes/
zip -r grow-guide-theme.zip grow-guide/ -x "*.DS_Store" "*.git*" "node_modules/*"
```

#### 2. Required WordPress Environment

- **WordPress Version**: 5.0 or higher
- **PHP Version**: 7.4 or higher
- **MySQL Version**: 5.6 or higher
- **Memory Limit**: 256MB recommended
- **Max Execution Time**: 300 seconds recommended

#### 3. Required Plugins (Recommended)

- **Contact Form 7** or **WP Mail SMTP** (for contact form functionality)
- **Yoast SEO** or **RankMath** (for SEO optimization)
- **W3 Total Cache** or **WP Rocket** (for performance)
- **Wordfence** or **Sucuri** (for security)

### Deployment Steps

#### 1. Theme Installation

1. Upload `grow-guide` folder to `/wp-content/themes/`
2. Activate theme in WordPress Admin
3. Go to Settings > Permalinks > Save Changes (flush rewrite rules)

#### 2. Essential Configuration

**Create Navigation Menu:**

```
WordPress Admin > Appearance > Menus
- Create "Primary Menu"
- Add pages: Home, About, Learn to Grow, Pro Members, Contact
- Assign to "Primary Menu" location
```

**Configure Customizer:**

```
WordPress Admin > Appearance > Customize
- Set Hero Heading and Description
- Add App Store URLs
- Configure contact email
```

**Create Required Pages:**
Create pages with these exact slugs:

- `about` → About page
- `contact` → Contact page
- `learn-to-grow` → Learning resources
- `privacy` → Privacy policy
- `terms` → Terms of service
- `pro-members` → Pro features

#### 3. Content Setup

**Add Features:**

1. Go to Features > Add New
2. Add feature title and description
3. Set icon class (Font Awesome)
4. Publish

**Add Testimonials:**

1. Go to Testimonials > Add New
2. Add testimonial content
3. Set author name and title in meta boxes
4. Add author photo as featured image
5. Publish

#### 4. Email Configuration

**Option A: SMTP Plugin (Recommended)**

1. Install WP Mail SMTP plugin
2. Configure with your hosting provider's SMTP settings
3. Test email functionality

**Option B: Basic Configuration**

- Ensure hosting server supports PHP mail()
- May require additional server configuration

### Performance Optimization

#### 1. Caching Setup

```php
// Add to wp-config.php for basic caching
define('WP_CACHE', true);
```

#### 2. Image Optimization

- Install image optimization plugin (Smush, ShortPixel)
- Convert images to WebP format when possible
- Use appropriate image sizes

#### 3. CDN Setup (Optional)

- Configure CloudFlare or similar CDN
- Update asset URLs if needed

### Security Hardening

#### 1. Basic Security

```php
// Add to wp-config.php
define('DISALLOW_FILE_EDIT', true);
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
```

#### 2. File Permissions

```bash
# Set correct file permissions
find /path/to/wordpress/ -type d -exec chmod 755 {} \;
find /path/to/wordpress/ -type f -exec chmod 644 {} \;
chmod 600 wp-config.php
```

#### 3. Security Plugin

- Install and configure Wordfence or similar
- Enable firewall and malware scanning
- Set up login security

### SEO Configuration

#### 1. SEO Plugin Setup

- Install Yoast SEO or RankMath
- Configure site settings
- Set up XML sitemaps

#### 2. Analytics

- Install Google Analytics
- Set up Google Search Console
- Configure tracking codes

### Backup Strategy

#### 1. Automated Backups

- Set up daily database backups
- Include theme files in backup
- Store backups off-site

#### 2. Manual Backup Before Changes

```bash
# Database backup
mysqldump -u username -p database_name > backup.sql

# File backup
tar -czf website-backup.tar.gz /path/to/wordpress/
```

### Monitoring & Maintenance

#### 1. Regular Updates

- WordPress core updates
- Theme updates (if available)
- Plugin updates
- Security patches

#### 2. Performance Monitoring

- Monitor page load speeds
- Check for broken links
- Review error logs regularly

#### 3. Content Maintenance

- Update contact information
- Refresh testimonials
- Update app store links

### Troubleshooting Common Issues

#### 1. Contact Form Not Working

**Solutions:**

- Install SMTP plugin
- Check server mail configuration
- Verify email addresses are correct
- Test with different email providers

#### 2. Custom Post Types Not Showing

**Solutions:**

- Go to Settings > Permalinks > Save Changes
- Check if theme is properly activated
- Verify custom post type registration

#### 3. Customizer Settings Not Saving

**Solutions:**

- Check file permissions (wp-content should be writable)
- Temporarily deactivate plugins
- Increase memory limit in wp-config.php

#### 4. Mobile Menu Not Working

**Solutions:**

- Check JavaScript console for errors
- Verify jQuery is loaded correctly
- Check for plugin conflicts

### Development vs Production

#### Development Environment

```php
// wp-config.php for development
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
```

#### Production Environment

```php
// wp-config.php for production
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
```

### Post-Launch Testing

#### 1. Functionality Testing

- [ ] All pages load correctly
- [ ] Contact form works
- [ ] Navigation functions properly
- [ ] Mobile responsiveness verified
- [ ] App store links work

#### 2. Performance Testing

- [ ] Page speed tests (GTmetrix, PageSpeed Insights)
- [ ] Mobile performance testing
- [ ] Load testing under traffic

#### 3. SEO Testing

- [ ] Meta tags are present
- [ ] XML sitemap generated
- [ ] Search Console configured
- [ ] Analytics tracking verified

### Support & Maintenance Contacts

#### Hosting Provider

- Document hosting provider contact information
- Note server specifications and limits
- Keep renewal dates tracked

#### Domain Management

- Document domain registrar information
- Track expiration dates
- Maintain DNS configuration records

### Emergency Procedures

#### 1. Site Down Recovery

1. Check hosting server status
2. Restore from latest backup
3. Contact hosting provider if needed
4. Check for plugin conflicts

#### 2. Security Incident Response

1. Change all passwords immediately
2. Restore from clean backup
3. Scan for malware
4. Update all software
5. Review security logs

---

## Quick Reference Commands

### WordPress CLI (if available)

```bash
# Download WordPress
wp core download

# Update WordPress
wp core update

# Activate theme
wp theme activate grow-guide

# Flush rewrite rules
wp rewrite flush

# Export database
wp db export backup.sql
```

### File Management

```bash
# Upload theme
scp -r grow-guide/ user@server:/wp-content/themes/

# Set permissions
chmod -R 755 wp-content/themes/grow-guide/
chmod 644 wp-content/themes/grow-guide/style.css
```

This deployment guide ensures a smooth transition from development to production environment while maintaining security, performance, and functionality standards.
