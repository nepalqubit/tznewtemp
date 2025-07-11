<?php
/**
 * Shortcode Examples Template
 * 
 * This template provides examples of how to use TZnew theme shortcodes
 * within template files and can be included in any template.
 *
 * @package TZnew
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="shortcode-examples-container">
    <div class="shortcode-section">
        <h2><?php esc_html_e('Featured Tours Section', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display featured tours in a 3-column layout:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_featured_tours limit="3" columns="3"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Tours by Region', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display tours from Annapurna region:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_tours region="annapurna" limit="6" columns="3" show_price="true" show_duration="true"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Trekking Packages', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display challenging trekking packages:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_trekking difficulty="challenging" limit="4" columns="2" show_excerpt="true"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Recent Blog Posts', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display latest blog posts with reading time:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_recent_blogs limit="4" columns="2" show_reading_time="true" show_date="true"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('FAQ Section', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display frequently asked questions with accordion:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_faq limit="5" accordion="true"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Tour Grid Alternative Layout', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display tours in a list layout:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_tour_grid limit="4" layout="list" show_price="true" show_duration="true"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Company Information', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display company contact details:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_company_info show_phone="true" show_email="true" show_social="true"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Booking Form', 'tznew'); ?></h2>
        <p><?php esc_html_e('Display booking form for tours:', 'tznew'); ?></p>
        <?php echo do_shortcode('[tznew_booking_form title="Book Your Adventure Today"]'); ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Dynamic Content Example', 'tznew'); ?></h2>
        <p><?php esc_html_e('Example of using shortcodes with dynamic content:', 'tznew'); ?></p>
        <?php
        // Example of dynamic shortcode usage
        $current_region = get_query_var('region', 'annapurna');
        $tours_shortcode = '[tznew_tours region="' . esc_attr($current_region) . '" limit="6" columns="3"]';
        echo do_shortcode($tours_shortcode);
        ?>
    </div>

    <div class="shortcode-section">
        <h2><?php esc_html_e('Multiple Shortcodes Combination', 'tznew'); ?></h2>
        <p><?php esc_html_e('Combining multiple shortcodes for rich content:', 'tznew'); ?></p>
        
        <div class="row">
            <div class="col-md-8">
                <?php echo do_shortcode('[tznew_blog limit="3" columns="1" show_excerpt="true" show_reading_time="true"]'); ?>
            </div>
            <div class="col-md-4">
                <?php echo do_shortcode('[tznew_company_info show_phone="true" show_email="true"]'); ?>
                <?php echo do_shortcode('[tznew_featured_tours limit="2" columns="1"]'); ?>
            </div>
        </div>
    </div>
</div>

<style>
.shortcode-examples-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.shortcode-section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: #f9f9f9;
    border-radius: 8px;
    border-left: 4px solid var(--primary-color, #2563eb);
}

.shortcode-section h2 {
    color: var(--primary-color, #2563eb);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.shortcode-section p {
    color: #666;
    margin-bottom: 1.5rem;
    font-style: italic;
}

.row {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.col-md-8 {
    flex: 0 0 65%;
}

.col-md-4 {
    flex: 0 0 30%;
}

@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }
    
    .col-md-8,
    .col-md-4 {
        flex: 1;
    }
    
    .shortcode-examples-container {
        padding: 1rem;
    }
    
    .shortcode-section {
        padding: 1.5rem;
    }
}
</style>

<?php
/**
 * Usage Instructions:
 * 
 * To include this template in your theme files, use:
 * get_template_part('template-parts/shortcode-examples');
 * 
 * Or to include specific sections, you can copy the individual
 * do_shortcode() calls and use them in your templates.
 * 
 * Examples for template files:
 * 
 * // In front-page.php
 * echo do_shortcode('[tznew_featured_tours limit="3"]');
 * echo do_shortcode('[tznew_recent_blogs limit="4" columns="2"]');
 * 
 * // In page-tours.php
 * echo do_shortcode('[tznew_tours limit="12" columns="4"]');
 * 
 * // In sidebar.php
 * echo do_shortcode('[tznew_company_info]');
 * echo do_shortcode('[tznew_faq limit="3" accordion="true"]');
 * 
 * // Dynamic usage based on current page
 * if (is_page('tours')) {
 *     echo do_shortcode('[tznew_tours limit="9" columns="3"]');
 * } elseif (is_page('trekking')) {
 *     echo do_shortcode('[tznew_trekking limit="9" columns="3"]');
 * }
 * 
 * // With conditional parameters
 * $region = get_query_var('region');
 * if ($region) {
 *     echo do_shortcode('[tznew_tours region="' . $region . '" limit="12"]');
 * } else {
 *     echo do_shortcode('[tznew_featured_tours limit="6"]');
 * }
 */
?>