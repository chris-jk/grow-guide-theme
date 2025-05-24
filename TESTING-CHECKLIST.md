# WordPress Theme Testing Checklist

## Pre-Installation Testing

### File Structure Verification ✅

- [x] style.css (with proper theme header)
- [x] functions.php (theme functionality)
- [x] index.php (main template)
- [x] header.php (site header)
- [x] footer.php (site footer)
- [x] page.php (generic page template)
- [x] single.php (blog post template)
- [x] archive.php (archive template)
- [x] search.php (search results)
- [x] 404.php (error page)
- [x] comments.php (comments template)
- [x] sidebar.php (sidebar template)
- [x] searchform.php (search form)

### Custom Templates ✅

- [x] page-about.php
- [x] page-contact.php
- [x] page-learn.php
- [x] page-privacy.php
- [x] page-terms.php
- [x] page-pro.php
- [x] category.php
- [x] tag.php
- [x] author.php
- [x] date.php
- [x] archive-features.php
- [x] archive-testimonials.php
- [x] single-features.php
- [x] single-testimonials.php

### Assets ✅

- [x] CSS files copied
- [x] JavaScript files copied
- [x] Images copied
- [x] Video files copied

## Installation Testing

### Theme Activation

- [ ] Upload theme to `/wp-content/themes/`
- [ ] Rename folder to `grow-guide`
- [ ] Activate theme in WordPress admin
- [ ] Check for any PHP errors
- [ ] Verify theme displays correctly

### Required WordPress Setup

- [ ] Go to Settings > Permalinks > Save (flush rewrite rules)
- [ ] Create primary navigation menu
- [ ] Assign menu to "Primary Menu" location
- [ ] Test navigation functionality

### Customizer Testing

- [ ] Go to Appearance > Customize
- [ ] Test Hero Section settings:
  - [ ] Hero Heading
  - [ ] Hero Description
- [ ] Test App Store Links:
  - [ ] iOS App Store URL
  - [ ] Google Play Store URL
- [ ] Test Contact Settings:
  - [ ] Contact Email
- [ ] Verify changes save and display

### Page Creation

Create pages with exact slugs for template matching:

- [ ] About (slug: `about`)
- [ ] Contact (slug: `contact`)
- [ ] Learn to Grow (slug: `learn-to-grow`)
- [ ] Privacy Policy (slug: `privacy`)
- [ ] Terms of Service (slug: `terms`)
- [ ] Pro Members (slug: `pro-members`)

### Custom Post Types

- [ ] Check Features post type exists in admin
- [ ] Create test feature with icon
- [ ] Verify feature displays on homepage
- [ ] Check Features archive page
- [ ] Check Testimonials post type exists
- [ ] Create test testimonial with author info
- [ ] Add author image (featured image)
- [ ] Verify testimonial displays correctly

### Widget Areas

- [ ] Go to Appearance > Widgets
- [ ] Test Footer Widget Area 1
- [ ] Test Footer Widget Area 2
- [ ] Test Footer Widget Area 3
- [ ] Test Primary Sidebar (for blog)

### Contact Form

- [ ] Configure SMTP plugin (recommended)
- [ ] Test contact form submission
- [ ] Verify email receipt
- [ ] Test form validation
- [ ] Test success/error messages

## Functionality Testing

### Homepage

- [ ] Hero section displays correctly
- [ ] App store buttons work
- [ ] Features section shows custom features
- [ ] Testimonials section displays
- [ ] All sections responsive on mobile

### Blog Functionality

- [ ] Create test blog posts
- [ ] Check single post template
- [ ] Test comments functionality
- [ ] Test categories and tags
- [ ] Check archive pages
- [ ] Test search functionality
- [ ] Test pagination

### Navigation

- [ ] Primary menu works on desktop
- [ ] Mobile menu functions correctly
- [ ] Footer menu displays
- [ ] Breadcrumb navigation (if implemented)

### Responsive Design

- [ ] Test on mobile devices
- [ ] Test on tablets
- [ ] Test on desktop
- [ ] Check all breakpoints
- [ ] Verify touch interactions work

### Performance

- [ ] Check page load speeds
- [ ] Verify images are optimized
- [ ] Test with caching plugin
- [ ] Check for console errors
- [ ] Validate HTML/CSS

### SEO Features

- [ ] Check page titles
- [ ] Verify meta descriptions
- [ ] Test Open Graph tags
- [ ] Check structured data
- [ ] Test XML sitemap generation

### Security

- [ ] Test for XSS vulnerabilities
- [ ] Check form nonce validation
- [ ] Verify input sanitization
- [ ] Test file upload restrictions

## Browser Testing

### Desktop Browsers

- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)

### Mobile Browsers

- [ ] Chrome Mobile
- [ ] Safari Mobile
- [ ] Firefox Mobile

## Accessibility Testing

### WCAG Compliance

- [ ] Keyboard navigation works
- [ ] Screen reader compatibility
- [ ] Alt text for images
- [ ] Proper heading structure
- [ ] Color contrast ratios
- [ ] Focus indicators visible

### Tools

- [ ] WAVE accessibility checker
- [ ] Lighthouse accessibility audit
- [ ] Keyboard-only navigation test

## Final Checks

### Code Quality

- [ ] PHP errors/warnings check
- [ ] JavaScript console errors
- [ ] CSS validation
- [ ] WordPress coding standards
- [ ] Theme check plugin

### Documentation

- [ ] README.md complete
- [ ] SETUP.md accurate
- [ ] Installation instructions clear
- [ ] Customization guide helpful

### Backup & Deployment

- [ ] Create theme package
- [ ] Test installation on clean WordPress
- [ ] Document any dependencies
- [ ] Create deployment checklist

## Known Issues to Check

### Common WordPress Theme Issues

- [ ] Custom post type permalinks working
- [ ] Featured images displaying correctly
- [ ] Widget areas functioning
- [ ] Menu locations assigned
- [ ] Customizer options saving
- [ ] Contact form emails sending

### Mobile-Specific Issues

- [ ] Touch targets adequate size
- [ ] Text readable without zooming
- [ ] Horizontal scrolling eliminated
- [ ] Form inputs work on mobile

### Performance Issues

- [ ] Large image optimization
- [ ] Script loading optimization
- [ ] Font loading efficiency
- [ ] Third-party script impact

## Post-Launch Monitoring

### Analytics Setup

- [ ] Google Analytics installed
- [ ] Search Console configured
- [ ] Performance monitoring setup
- [ ] Error tracking enabled

### Maintenance Tasks

- [ ] Regular WordPress updates
- [ ] Theme security monitoring
- [ ] Performance optimization
- [ ] Content backup strategy

---

## Troubleshooting Common Issues

**Custom Post Types Not Showing**

- Go to Settings > Permalinks > Save Changes

**Customizer Not Saving**

- Check file permissions
- Deactivate plugins temporarily

**Contact Form Not Working**

- Install SMTP plugin
- Check email configuration
- Verify nonce security

**Mobile Menu Not Working**

- Check JavaScript console for errors
- Verify jQuery is loaded

**Images Not Loading**

- Check file paths in theme
- Verify upload permissions
- Test image optimization plugins
