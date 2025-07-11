# TZnew WordPress Theme

A full-featured, production-ready WordPress theme for Techzen Corporation.

## Requirements

- **WordPress**: 6.6 or higher
- **PHP**: 8.2 or higher
- **ACF Pro**: Required for custom fields functionality
- **Elementor**: Optional (theme includes Elementor integration)
- **WooCommerce**: Optional (theme includes WooCommerce integration)

## Features

### Custom Post Types
- **Trekking**: Complete trekking package management
- **Tours**: Tour package management
- **FAQ**: Frequently asked questions
- **Blog**: Custom blog posts with ACF integration

### Custom Taxonomies
- **Region**: For trekking and tours (Annapurna, Everest, Langtang, etc.)
- **Difficulty**: For trekking (Easy, Moderate, Challenging, Strenuous)
- **Tour Type**: For tours
- **ACF Tag**: For blog posts

### Integrations
- **ACF Pro**: Extensive custom fields for all post types
- **Elementor**: Custom widgets and theme support
- **WooCommerce**: E-commerce functionality with custom product linking
- **REST API**: Full API support for all custom post types and fields
- **Tailwind CSS**: Modern utility-first CSS framework

### PHP 8.2+ Compatibility
This theme has been fully updated for PHP 8.2+ compatibility including:
- Proper null coalescing operator usage
- Array access validation
- Secure $_GET/$_POST handling
- Modern WordPress coding standards

### Security Features
- Sanitized input handling
- Escaped output
- Nonce verification for forms
- Secure file access checks

## Installation

1. Upload the theme to `/wp-content/themes/tznew/`
2. Activate the theme in WordPress admin
3. Install and activate required plugins (ACF Pro)
4. Import ACF field groups from `/acf-json/` directory
5. Configure theme options in Customizer

## Development

The theme uses modern development practices:
- Tailwind CSS for styling
- Modular PHP architecture
- REST API endpoints
- Custom post types and taxonomies
- Advanced Custom Fields integration

## WordPress Shortcodes

The TZnew theme includes a comprehensive set of WordPress shortcodes for easy content integration. All shortcodes are fully responsive and customizable.

### Tours Shortcode

Display tours with various filtering and layout options.

```
[tznew_tours limit="6" region="annapurna" tour_type="adventure" difficulty="moderate" orderby="date" order="DESC" show_excerpt="true" show_price="true" show_duration="true" columns="3" class="custom-class"]
```

**Parameters:**
- `limit` (default: 6) - Number of tours to display
- `region` - Filter by region slug (annapurna, everest, langtang, etc.)
- `tour_type` - Filter by tour type slug
- `difficulty` - Filter by difficulty slug (easy, moderate, challenging, strenuous)
- `orderby` (default: date) - Sort order (date, title, menu_order)
- `order` (default: DESC) - ASC or DESC
- `show_excerpt` (default: true) - Show/hide excerpt
- `show_price` (default: true) - Show/hide price
- `show_duration` (default: true) - Show/hide duration
- `columns` (default: 3) - Number of columns (1-4)
- `class` - Additional CSS classes

### Trekking Shortcode

Display trekking packages with filtering options.

```
[tznew_trekking limit="6" region="everest" difficulty="challenging" orderby="date" order="DESC" show_excerpt="true" show_price="true" show_duration="true" columns="3" class="custom-class"]
```

**Parameters:**
- `limit` (default: 6) - Number of trekking packages to display
- `region` - Filter by region slug
- `difficulty` - Filter by difficulty slug
- `orderby` (default: date) - Sort order
- `order` (default: DESC) - ASC or DESC
- `show_excerpt` (default: true) - Show/hide excerpt
- `show_price` (default: true) - Show/hide price
- `show_duration` (default: true) - Show/hide duration
- `columns` (default: 3) - Number of columns (1-4)
- `class` - Additional CSS classes

### Blog Posts Shortcode

Display blog posts with various options.

```
[tznew_blog limit="6" category="travel" tag="tips" orderby="date" order="DESC" show_excerpt="true" show_date="true" show_author="true" show_reading_time="true" columns="3" class="custom-class"]
```

**Parameters:**
- `limit` (default: 6) - Number of blog posts to display
- `category` - Filter by category slug
- `tag` - Filter by ACF tag slug
- `orderby` (default: date) - Sort order
- `order` (default: DESC) - ASC or DESC
- `show_excerpt` (default: true) - Show/hide excerpt
- `show_date` (default: true) - Show/hide publication date
- `show_author` (default: true) - Show/hide author
- `show_reading_time` (default: true) - Show/hide reading time
- `columns` (default: 3) - Number of columns (1-4)
- `class` - Additional CSS classes

### FAQ Shortcode

Display frequently asked questions with accordion functionality.

```
[tznew_faq limit="-1" category="general" orderby="menu_order" order="ASC" accordion="true" class="custom-class"]
```

**Parameters:**
- `limit` (default: -1) - Number of FAQs to display (-1 for all)
- `category` - Filter by FAQ category slug
- `orderby` (default: menu_order) - Sort order
- `order` (default: ASC) - ASC or DESC
- `accordion` (default: true) - Enable/disable accordion functionality
- `class` - Additional CSS classes

### Form Shortcodes

Display various contact and booking forms.

#### Booking Form
```
[tznew_booking_form title="Book Your Adventure" class="custom-class"]
```

#### Inquiry Form
```
[tznew_inquiry_form title="Send Us an Inquiry" class="custom-class"]
```

#### Customization Form
```
[tznew_customization_form title="Customize Your Trip" class="custom-class"]
```

**Parameters:**
- `title` - Form title/heading
- `class` - Additional CSS classes

### Featured Tours Shortcode

Display featured tours only.

```
[tznew_featured_tours limit="3" columns="3" class="custom-class"]
```

**Parameters:**
- `limit` (default: 3) - Number of featured tours to display
- `columns` (default: 3) - Number of columns (1-4)
- `class` - Additional CSS classes

### Recent Blog Posts Shortcode

Display recent blog posts.

```
[tznew_recent_blogs limit="3" columns="3" show_date="true" show_excerpt="true" class="custom-class"]
```

**Parameters:**
- `limit` (default: 3) - Number of recent posts to display
- `columns` (default: 3) - Number of columns (1-4)
- `show_date` (default: true) - Show/hide publication date
- `show_excerpt` (default: true) - Show/hide excerpt
- `class` - Additional CSS classes

### Tour Grid Shortcode

Alternative tour display with different layout options.

```
[tznew_tour_grid limit="8" columns="4" show_price="true" show_duration="true" layout="grid" class="custom-class"]
```

**Parameters:**
- `limit` (default: 8) - Number of tours to display
- `columns` (default: 4) - Number of columns (1-4)
- `show_price` (default: true) - Show/hide price
- `show_duration` (default: true) - Show/hide duration
- `layout` (default: grid) - Layout type (grid, list, carousel)
- `class` - Additional CSS classes

### Company Info Shortcode

Display company contact information.

```
[tznew_company_info show_phone="true" show_email="true" show_address="true" show_social="true" class="custom-class"]
```

**Parameters:**
- `show_phone` (default: true) - Show/hide phone number
- `show_email` (default: true) - Show/hide email address
- `show_address` (default: true) - Show/hide physical address
- `show_social` (default: true) - Show/hide social media links
- `class` - Additional CSS classes

### Testimonials Shortcode (Placeholder)

Ready for implementation when testimonials post type is added.

```
[tznew_testimonials limit="3" columns="3" show_rating="true" class="custom-class"]
```

## Template Integration

Shortcodes can be used in:
- **Posts and Pages**: Add shortcodes directly in the content editor
- **Widgets**: Use in text widgets or custom HTML widgets
- **Template Files**: Use `do_shortcode()` function in PHP templates
- **Elementor**: Use the Shortcode widget to embed any shortcode
- **Customizer**: Add shortcodes in customizer text areas

### Template Usage Examples

```php
// In template files
echo do_shortcode('[tznew_tours limit="6" columns="3"]');

// With dynamic attributes
$region = get_query_var('region');
echo do_shortcode('[tznew_tours region="' . $region . '" limit="9"]');

// Multiple shortcodes
echo do_shortcode('[tznew_featured_tours limit="3"]');
echo do_shortcode('[tznew_recent_blogs limit="4" columns="2"]');
```

### Styling and Customization

All shortcodes include:
- **Responsive Design**: Automatically adapts to different screen sizes
- **CSS Classes**: Each element has specific CSS classes for customization
- **Custom Classes**: Add your own CSS classes via the `class` parameter
- **Theme Integration**: Inherits theme colors and typography
- **Accessibility**: Proper ARIA labels and keyboard navigation

### Performance Considerations

- Shortcodes use efficient WordPress queries with proper caching
- Images are properly sized and optimized
- CSS is loaded only when shortcodes are used
- JavaScript is minimized and loaded conditionally

## Support

For support and documentation, visit [Techzen Corporation](https://techzeninc.com)

## License

GNU General Public License v2 or later