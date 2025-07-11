<?php
/**
 * TZnew Theme Shortcodes
 *
 * @package TZnew
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register all theme shortcodes
 */
function tznew_register_shortcodes() {
    add_shortcode('tznew_tours', 'tznew_tours_shortcode');
    add_shortcode('tznew_trekking', 'tznew_trekking_shortcode');
    add_shortcode('tznew_blog', 'tznew_blog_shortcode');
    add_shortcode('tznew_faq', 'tznew_faq_shortcode');
    add_shortcode('tznew_booking_form', 'tznew_booking_form_shortcode');
    add_shortcode('tznew_inquiry_form', 'tznew_inquiry_form_shortcode');
    add_shortcode('tznew_customization_form', 'tznew_customization_form_shortcode');
    add_shortcode('tznew_tour_grid', 'tznew_tour_grid_shortcode');
    add_shortcode('tznew_featured_tours', 'tznew_featured_tours_shortcode');
    add_shortcode('tznew_recent_blogs', 'tznew_recent_blogs_shortcode');
    add_shortcode('tznew_testimonials', 'tznew_testimonials_shortcode');
    add_shortcode('tznew_company_info', 'tznew_company_info_shortcode');
}
add_action('init', 'tznew_register_shortcodes');

/**
 * Tours listing shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_tours_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 6,
        'region' => '',
        'tour_type' => '',
        'difficulty' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'show_excerpt' => 'true',
        'show_price' => 'true',
        'show_duration' => 'true',
        'columns' => 3,
        'class' => ''
    ], $atts, 'tznew_tours');

    $args = [
        'post_type' => 'tours',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => sanitize_text_field($atts['orderby']),
        'order' => sanitize_text_field($atts['order']),
        'post_status' => 'publish'
    ];

    // Add taxonomy filters
    $tax_query = [];
    if (!empty($atts['region'])) {
        $tax_query[] = [
            'taxonomy' => 'region',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['region'])
        ];
    }
    if (!empty($atts['tour_type'])) {
        $tax_query[] = [
            'taxonomy' => 'tour_type',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['tour_type'])
        ];
    }
    if (!empty($atts['difficulty'])) {
        $tax_query[] = [
            'taxonomy' => 'difficulty',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['difficulty'])
        ];
    }
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-tours-found">' . esc_html__('No tours found.', 'tznew') . '</p>';
    }

    $columns_class = 'columns-' . intval($atts['columns']);
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-tours-grid <?php echo esc_attr($columns_class . $custom_class); ?>">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="tour-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="tour-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="tour-content">
                    <h3 class="tour-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <?php if ($atts['show_duration'] === 'true') : ?>
                        <?php $duration = tznew_get_field_safe('duration', get_the_ID()); ?>
                        <?php if ($duration) : ?>
                            <div class="tour-duration">
                                <span class="duration-label"><?php esc_html_e('Duration:', 'tznew'); ?></span>
                                <span class="duration-value"><?php echo esc_html($duration . ' Days'); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if ($atts['show_excerpt'] === 'true') : ?>
                        <div class="tour-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($atts['show_price'] === 'true') : ?>
                        <?php $price = tznew_get_field_safe('price', get_the_ID()); ?>
                        <?php if ($price) : ?>
                            <div class="tour-price">
                                <span class="price-label"><?php esc_html_e('From:', 'tznew'); ?></span>
                                <span class="price-value">$<?php echo esc_html($price); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="tour-actions">
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                            <?php esc_html_e('View Details', 'tznew'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Trekking listing shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_trekking_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 6,
        'region' => '',
        'difficulty' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'show_excerpt' => 'true',
        'show_price' => 'true',
        'show_duration' => 'true',
        'columns' => 3,
        'class' => ''
    ], $atts, 'tznew_trekking');

    $args = [
        'post_type' => 'trekking',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => sanitize_text_field($atts['orderby']),
        'order' => sanitize_text_field($atts['order']),
        'post_status' => 'publish'
    ];

    // Add taxonomy filters
    $tax_query = [];
    if (!empty($atts['region'])) {
        $tax_query[] = [
            'taxonomy' => 'region',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['region'])
        ];
    }
    if (!empty($atts['difficulty'])) {
        $tax_query[] = [
            'taxonomy' => 'difficulty',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['difficulty'])
        ];
    }
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-trekking-found">' . esc_html__('No trekking packages found.', 'tznew') . '</p>';
    }

    $columns_class = 'columns-' . intval($atts['columns']);
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-trekking-grid <?php echo esc_attr($columns_class . $custom_class); ?>">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="trekking-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="trekking-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="trekking-content">
                    <h3 class="trekking-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <?php if ($atts['show_duration'] === 'true') : ?>
                        <?php $duration = tznew_get_field_safe('duration', get_the_ID()); ?>
                        <?php if ($duration) : ?>
                            <div class="trekking-duration">
                                <span class="duration-label"><?php esc_html_e('Duration:', 'tznew'); ?></span>
                                <span class="duration-value"><?php echo esc_html($duration . ' Days'); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if ($atts['show_excerpt'] === 'true') : ?>
                        <div class="trekking-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($atts['show_price'] === 'true') : ?>
                        <?php $price = tznew_get_field_safe('price', get_the_ID()); ?>
                        <?php if ($price) : ?>
                            <div class="trekking-price">
                                <span class="price-label"><?php esc_html_e('From:', 'tznew'); ?></span>
                                <span class="price-value">$<?php echo esc_html($price); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="trekking-actions">
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                            <?php esc_html_e('View Details', 'tznew'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Blog posts shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_blog_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 6,
        'category' => '',
        'tag' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'show_excerpt' => 'true',
        'show_date' => 'true',
        'show_author' => 'true',
        'show_reading_time' => 'true',
        'columns' => 3,
        'class' => ''
    ], $atts, 'tznew_blog');

    $args = [
        'post_type' => 'blog',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => sanitize_text_field($atts['orderby']),
        'order' => sanitize_text_field($atts['order']),
        'post_status' => 'publish'
    ];

    // Add taxonomy filters
    $tax_query = [];
    if (!empty($atts['category'])) {
        $tax_query[] = [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['category'])
        ];
    }
    if (!empty($atts['tag'])) {
        $tax_query[] = [
            'taxonomy' => 'acf_tag',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['tag'])
        ];
    }
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-blog-found">' . esc_html__('No blog posts found.', 'tznew') . '</p>';
    }

    $columns_class = 'columns-' . intval($atts['columns']);
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-blog-grid <?php echo esc_attr($columns_class . $custom_class); ?>">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="blog-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="blog-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="blog-content">
                    <h3 class="blog-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="blog-meta">
                        <?php if ($atts['show_date'] === 'true') : ?>
                            <span class="blog-date"><?php echo get_the_date(); ?></span>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_author'] === 'true') : ?>
                            <span class="blog-author"><?php esc_html_e('By', 'tznew'); ?> <?php the_author(); ?></span>
                        <?php endif; ?>
                        
                        <?php if ($atts['show_reading_time'] === 'true') : ?>
                            <?php $reading_time = tznew_get_reading_time(get_the_content()); ?>
                            <span class="reading-time"><?php echo esc_html($reading_time . ' min read'); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($atts['show_excerpt'] === 'true') : ?>
                        <div class="blog-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="blog-actions">
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                            <?php esc_html_e('Read More', 'tznew'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * FAQ shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_faq_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => -1,
        'category' => '',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'accordion' => 'true',
        'class' => ''
    ], $atts, 'tznew_faq');

    $args = [
        'post_type' => 'faq',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => sanitize_text_field($atts['orderby']),
        'order' => sanitize_text_field($atts['order']),
        'post_status' => 'publish'
    ];

    if (!empty($atts['category'])) {
        $args['tax_query'] = [[
            'taxonomy' => 'faq_category',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['category'])
        ]];
    }

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-faq-found">' . esc_html__('No FAQs found.', 'tznew') . '</p>';
    }

    $accordion_class = $atts['accordion'] === 'true' ? 'faq-accordion' : 'faq-list';
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-faq <?php echo esc_attr($accordion_class . $custom_class); ?>">
        <?php $counter = 0; ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php $counter++; ?>
            <div class="faq-item" data-faq="<?php echo esc_attr($counter); ?>">
                <div class="faq-question" <?php if ($atts['accordion'] === 'true') : ?>role="button" tabindex="0"<?php endif; ?>>
                    <h3><?php the_title(); ?></h3>
                    <?php if ($atts['accordion'] === 'true') : ?>
                        <span class="faq-toggle">+</span>
                    <?php endif; ?>
                </div>
                <div class="faq-answer" <?php if ($atts['accordion'] === 'true') : ?>style="display: none;"<?php endif; ?>>
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    
    <?php if ($atts['accordion'] === 'true') : ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(function(question) {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const toggle = this.querySelector('.faq-toggle');
                
                if (answer.style.display === 'none' || answer.style.display === '') {
                    answer.style.display = 'block';
                    toggle.textContent = '-';
                } else {
                    answer.style.display = 'none';
                    toggle.textContent = '+';
                }
            });
        });
    });
    </script>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Booking form shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_booking_form_shortcode($atts) {
    $atts = shortcode_atts([
        'title' => 'Book Your Adventure',
        'class' => ''
    ], $atts, 'tznew_booking_form');

    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-booking-form-wrapper<?php echo esc_attr($custom_class); ?>">
        <?php if (!empty($atts['title'])) : ?>
            <h3 class="booking-form-title"><?php echo esc_html($atts['title']); ?></h3>
        <?php endif; ?>
        <?php get_template_part('template-parts/booking-form'); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Inquiry form shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_inquiry_form_shortcode($atts) {
    $atts = shortcode_atts([
        'title' => 'Send Us an Inquiry',
        'class' => ''
    ], $atts, 'tznew_inquiry_form');

    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-inquiry-form-wrapper<?php echo esc_attr($custom_class); ?>">
        <?php if (!empty($atts['title'])) : ?>
            <h3 class="inquiry-form-title"><?php echo esc_html($atts['title']); ?></h3>
        <?php endif; ?>
        <?php get_template_part('template-parts/inquiry-form'); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Customization form shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_customization_form_shortcode($atts) {
    $atts = shortcode_atts([
        'title' => 'Customize Your Trip',
        'class' => ''
    ], $atts, 'tznew_customization_form');

    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-customization-form-wrapper<?php echo esc_attr($custom_class); ?>">
        <?php if (!empty($atts['title'])) : ?>
            <h3 class="customization-form-title"><?php echo esc_html($atts['title']); ?></h3>
        <?php endif; ?>
        <?php get_template_part('template-parts/customization-form'); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Featured tours shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_featured_tours_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 3,
        'columns' => 3,
        'class' => ''
    ], $atts, 'tznew_featured_tours');

    $args = [
        'post_type' => 'tours',
        'posts_per_page' => intval($atts['limit']),
        'meta_query' => [[
            'key' => 'featured',
            'value' => '1',
            'compare' => '='
        ]],
        'post_status' => 'publish'
    ];

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-featured-tours">' . esc_html__('No featured tours found.', 'tznew') . '</p>';
    }

    $columns_class = 'columns-' . intval($atts['columns']);
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-featured-tours <?php echo esc_attr($columns_class . $custom_class); ?>">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="featured-tour-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="tour-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                        <div class="featured-badge"><?php esc_html_e('Featured', 'tznew'); ?></div>
                    </div>
                <?php endif; ?>
                
                <div class="tour-content">
                    <h3 class="tour-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="tour-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                    </div>
                    
                    <div class="tour-actions">
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                            <?php esc_html_e('Explore Tour', 'tznew'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Recent blog posts shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_recent_blogs_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 3,
        'columns' => 3,
        'show_date' => 'true',
        'show_excerpt' => 'true',
        'class' => ''
    ], $atts, 'tznew_recent_blogs');

    $args = [
        'post_type' => 'blog',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish'
    ];

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-recent-blogs">' . esc_html__('No recent blog posts found.', 'tznew') . '</p>';
    }

    $columns_class = 'columns-' . intval($atts['columns']);
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-recent-blogs <?php echo esc_attr($columns_class . $custom_class); ?>">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="recent-blog-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="blog-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="blog-content">
                    <h3 class="blog-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <?php if ($atts['show_date'] === 'true') : ?>
                        <div class="blog-date"><?php echo get_the_date(); ?></div>
                    <?php endif; ?>
                    
                    <?php if ($atts['show_excerpt'] === 'true') : ?>
                        <div class="blog-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="blog-actions">
                        <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                            <?php esc_html_e('Read More', 'tznew'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Company info shortcode
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_company_info_shortcode($atts) {
    $atts = shortcode_atts([
        'show_phone' => 'true',
        'show_email' => 'true',
        'show_address' => 'true',
        'show_social' => 'true',
        'class' => ''
    ], $atts, 'tznew_company_info');

    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-company-info<?php echo esc_attr($custom_class); ?>">
        <?php if ($atts['show_phone'] === 'true') : ?>
            <?php $phone = get_theme_mod('company_phone', ''); ?>
            <?php if ($phone) : ?>
                <div class="company-phone">
                    <span class="label"><?php esc_html_e('Phone:', 'tznew'); ?></span>
                    <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if ($atts['show_email'] === 'true') : ?>
            <?php $email = get_theme_mod('company_email', ''); ?>
            <?php if ($email) : ?>
                <div class="company-email">
                    <span class="label"><?php esc_html_e('Email:', 'tznew'); ?></span>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if ($atts['show_address'] === 'true') : ?>
            <?php $address = get_theme_mod('company_address', ''); ?>
            <?php if ($address) : ?>
                <div class="company-address">
                    <span class="label"><?php esc_html_e('Address:', 'tznew'); ?></span>
                    <span><?php echo esc_html($address); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if ($atts['show_social'] === 'true') : ?>
            <div class="company-social">
                <?php
                $social_links = [
                    'facebook' => get_theme_mod('social_facebook', ''),
                    'twitter' => get_theme_mod('social_twitter', ''),
                    'instagram' => get_theme_mod('social_instagram', ''),
                    'youtube' => get_theme_mod('social_youtube', '')
                ];
                ?>
                <?php foreach ($social_links as $platform => $url) : ?>
                    <?php if ($url) : ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="social-link social-<?php echo esc_attr($platform); ?>">
                            <?php echo esc_html(ucfirst($platform)); ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Tour grid shortcode (alternative layout)
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_tour_grid_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 8,
        'columns' => 4,
        'show_price' => 'true',
        'show_duration' => 'true',
        'layout' => 'grid', // grid, list, carousel
        'class' => ''
    ], $atts, 'tznew_tour_grid');

    $args = [
        'post_type' => 'tours',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish'
    ];

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '<p class="no-tours-grid">' . esc_html__('No tours available.', 'tznew') . '</p>';
    }

    $layout_class = 'layout-' . sanitize_html_class($atts['layout']);
    $columns_class = 'columns-' . intval($atts['columns']);
    $custom_class = !empty($atts['class']) ? ' ' . sanitize_html_class($atts['class']) : '';
    
    ob_start();
    ?>
    <div class="tznew-tour-grid <?php echo esc_attr($layout_class . ' ' . $columns_class . $custom_class); ?>">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="tour-grid-item">
                <div class="tour-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="tour-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="tour-info">
                        <h4 class="tour-name">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        
                        <div class="tour-details">
                            <?php if ($atts['show_duration'] === 'true') : ?>
                                <?php $duration = tznew_get_field_safe('duration', get_the_ID()); ?>
                                <?php if ($duration) : ?>
                                    <span class="tour-duration"><?php echo esc_html($duration . ' Days'); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php if ($atts['show_price'] === 'true') : ?>
                                <?php $price = tznew_get_field_safe('price', get_the_ID()); ?>
                                <?php if ($price) : ?>
                                    <span class="tour-price">$<?php echo esc_html($price); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="tour-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Testimonials shortcode (placeholder for future implementation)
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function tznew_testimonials_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 3,
        'columns' => 3,
        'show_rating' => 'true',
        'class' => ''
    ], $atts, 'tznew_testimonials');

    // This is a placeholder for testimonials functionality
    // You can implement this when you add testimonials post type
    
    return '<div class="tznew-testimonials-placeholder">' . 
           '<p>' . esc_html__('Testimonials shortcode is ready for implementation when testimonials post type is added.', 'tznew') . '</p>' .
           '</div>';
}