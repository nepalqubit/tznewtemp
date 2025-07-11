<?php
/**
 * Theme Customizer with Advanced Color System
 *
 * @package TZnew
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add customizer settings
 */
function tznew_customize_register($wp_customize) {
    
    // Add Color Scheme Panel
    $wp_customize->add_panel('tznew_color_scheme', array(
        'title'       => __('Color Scheme', 'tznew'),
        'description' => __('Customize your theme colors with gradients and opacity settings', 'tznew'),
        'priority'    => 30,
    ));
    
    // Primary Colors Section
    $wp_customize->add_section('tznew_primary_colors', array(
        'title'    => __('Primary Colors', 'tznew'),
        'panel'    => 'tznew_color_scheme',
        'priority' => 10,
    ));
    
    // Primary Color
    $wp_customize->add_setting('tznew_primary_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_primary_color', array(
        'label'    => __('Primary Color', 'tznew'),
        'section'  => 'tznew_primary_colors',
        'settings' => 'tznew_primary_color',
    )));
    
    // Primary Color Opacity
    $wp_customize->add_setting('tznew_primary_opacity', array(
        'default'           => 100,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_primary_opacity', array(
        'label'       => __('Primary Color Opacity (%)', 'tznew'),
        'section'     => 'tznew_primary_colors',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Secondary Color
    $wp_customize->add_setting('tznew_secondary_color', array(
        'default'           => '#059669',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_secondary_color', array(
        'label'    => __('Secondary Color', 'tznew'),
        'section'  => 'tznew_primary_colors',
        'settings' => 'tznew_secondary_color',
    )));
    
    // Secondary Color Opacity
    $wp_customize->add_setting('tznew_secondary_opacity', array(
        'default'           => 100,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_secondary_opacity', array(
        'label'       => __('Secondary Color Opacity (%)', 'tznew'),
        'section'     => 'tznew_primary_colors',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Accent Color
    $wp_customize->add_setting('tznew_accent_color', array(
        'default'           => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_accent_color', array(
        'label'    => __('Accent Color', 'tznew'),
        'section'  => 'tznew_primary_colors',
        'settings' => 'tznew_accent_color',
    )));
    
    // Accent Color Opacity
    $wp_customize->add_setting('tznew_accent_opacity', array(
        'default'           => 100,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_accent_opacity', array(
        'label'       => __('Accent Color Opacity (%)', 'tznew'),
        'section'     => 'tznew_primary_colors',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Gradient Settings Section
    $wp_customize->add_section('tznew_gradient_settings', array(
        'title'    => __('Gradient Settings', 'tznew'),
        'panel'    => 'tznew_color_scheme',
        'priority' => 20,
    ));
    
    // Enable Gradients
    $wp_customize->add_setting('tznew_enable_gradients', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_enable_gradients', array(
        'label'   => __('Enable Gradient Effects', 'tznew'),
        'section' => 'tznew_gradient_settings',
        'type'    => 'checkbox',
    ));
    
    // Gradient Direction
    $wp_customize->add_setting('tznew_gradient_direction', array(
        'default'           => 'to-br',
        'sanitize_callback' => 'tznew_sanitize_gradient_direction',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_gradient_direction', array(
        'label'   => __('Gradient Direction', 'tznew'),
        'section' => 'tznew_gradient_settings',
        'type'    => 'select',
        'choices' => array(
            'to-t'   => __('To Top', 'tznew'),
            'to-tr'  => __('To Top Right', 'tznew'),
            'to-r'   => __('To Right', 'tznew'),
            'to-br'  => __('To Bottom Right', 'tznew'),
            'to-b'   => __('To Bottom', 'tznew'),
            'to-bl'  => __('To Bottom Left', 'tznew'),
            'to-l'   => __('To Left', 'tznew'),
            'to-tl'  => __('To Top Left', 'tznew'),
        ),
    ));
    
    // Gradient Start Color
    $wp_customize->add_setting('tznew_gradient_start', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_gradient_start', array(
        'label'    => __('Gradient Start Color', 'tznew'),
        'section'  => 'tznew_gradient_settings',
        'settings' => 'tznew_gradient_start',
    )));
    
    // Gradient End Color
    $wp_customize->add_setting('tznew_gradient_end', array(
        'default'           => '#059669',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_gradient_end', array(
        'label'    => __('Gradient End Color', 'tznew'),
        'section'  => 'tznew_gradient_settings',
        'settings' => 'tznew_gradient_end',
    )));
    
    // Text Colors Section
    $wp_customize->add_section('tznew_text_colors', array(
        'title'    => __('Text Colors', 'tznew'),
        'panel'    => 'tznew_color_scheme',
        'priority' => 30,
    ));
    
    // Dark Text Color
    $wp_customize->add_setting('tznew_text_dark', array(
        'default'           => '#1f2937',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_text_dark', array(
        'label'    => __('Dark Text Color', 'tznew'),
        'section'  => 'tznew_text_colors',
        'settings' => 'tznew_text_dark',
    )));
    
    // Light Text Color
    $wp_customize->add_setting('tznew_text_light', array(
        'default'           => '#6b7280',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_text_light', array(
        'label'    => __('Light Text Color', 'tznew'),
        'section'  => 'tznew_text_colors',
        'settings' => 'tznew_text_light',
    )));
    
    // Background Colors Section
    $wp_customize->add_section('tznew_background_colors', array(
        'title'    => __('Background Colors', 'tznew'),
        'panel'    => 'tznew_color_scheme',
        'priority' => 40,
    ));
    
    // Light Background
    $wp_customize->add_setting('tznew_bg_light', array(
        'default'           => '#f9fafb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_bg_light', array(
        'label'    => __('Light Background', 'tznew'),
        'section'  => 'tznew_background_colors',
        'settings' => 'tznew_bg_light',
    )));
    
    // White Background
    $wp_customize->add_setting('tznew_bg_white', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_bg_white', array(
        'label'    => __('White Background', 'tznew'),
        'section'  => 'tznew_background_colors',
        'settings' => 'tznew_bg_white',
    )));
    
    // Border Color
    $wp_customize->add_setting('tznew_border_color', array(
        'default'           => '#e5e7eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tznew_border_color', array(
        'label'    => __('Border Color', 'tznew'),
        'section'  => 'tznew_background_colors',
        'settings' => 'tznew_border_color',
    )));
    
    // Advanced Settings Section
    $wp_customize->add_section('tznew_advanced_colors', array(
        'title'    => __('Advanced Color Settings', 'tznew'),
        'panel'    => 'tznew_color_scheme',
        'priority' => 50,
    ));
    
    // Color Scheme Presets
    $wp_customize->add_setting('tznew_color_preset', array(
        'default'           => 'default',
        'sanitize_callback' => 'tznew_sanitize_color_preset',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_color_preset', array(
        'label'   => __('Color Scheme Presets', 'tznew'),
        'section' => 'tznew_advanced_colors',
        'type'    => 'select',
        'choices' => array(
            'default'   => __('Default Blue & Green', 'tznew'),
            'sunset'    => __('Sunset Orange & Pink', 'tznew'),
            'ocean'     => __('Ocean Blue & Teal', 'tznew'),
            'forest'    => __('Forest Green & Brown', 'tznew'),
            'purple'    => __('Purple & Violet', 'tznew'),
            'monochrome' => __('Monochrome Gray', 'tznew'),
            'custom'    => __('Custom Colors', 'tznew'),
        ),
    ));
    
    // Dark Mode Toggle
    $wp_customize->add_setting('tznew_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_dark_mode', array(
        'label'   => __('Enable Dark Mode Support', 'tznew'),
        'section' => 'tznew_advanced_colors',
        'type'    => 'checkbox',
    ));
    
    // Animation Speed
    $wp_customize->add_setting('tznew_animation_speed', array(
        'default'           => 300,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tznew_animation_speed', array(
        'label'       => __('Animation Speed (ms)', 'tznew'),
        'section'     => 'tznew_advanced_colors',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 100,
            'max'  => 1000,
            'step' => 50,
        ),
    ));
}
add_action('customize_register', 'tznew_customize_register');

/**
 * Sanitize gradient direction
 */
function tznew_sanitize_gradient_direction($input) {
    $valid_directions = array('to-t', 'to-tr', 'to-r', 'to-br', 'to-b', 'to-bl', 'to-l', 'to-tl');
    return in_array($input, $valid_directions) ? $input : 'to-br';
}

/**
 * Sanitize color preset
 */
function tznew_sanitize_color_preset($input) {
    $valid_presets = array('default', 'sunset', 'ocean', 'forest', 'purple', 'monochrome', 'custom');
    return in_array($input, $valid_presets) ? $input : 'default';
}

/**
 * Generate CSS custom properties
 */
function tznew_generate_css_variables() {
    $primary_color = get_theme_mod('tznew_primary_color', '#2563eb');
    $primary_opacity = get_theme_mod('tznew_primary_opacity', 100);
    $secondary_color = get_theme_mod('tznew_secondary_color', '#059669');
    $secondary_opacity = get_theme_mod('tznew_secondary_opacity', 100);
    $accent_color = get_theme_mod('tznew_accent_color', '#f59e0b');
    $accent_opacity = get_theme_mod('tznew_accent_opacity', 100);
    $text_dark = get_theme_mod('tznew_text_dark', '#1f2937');
    $text_light = get_theme_mod('tznew_text_light', '#6b7280');
    $bg_light = get_theme_mod('tznew_bg_light', '#f9fafb');
    $bg_white = get_theme_mod('tznew_bg_white', '#ffffff');
    $border_color = get_theme_mod('tznew_border_color', '#e5e7eb');
    $enable_gradients = get_theme_mod('tznew_enable_gradients', true);
    $gradient_direction = get_theme_mod('tznew_gradient_direction', 'to-br');
    $gradient_start = get_theme_mod('tznew_gradient_start', '#2563eb');
    $gradient_end = get_theme_mod('tznew_gradient_end', '#059669');
    $animation_speed = get_theme_mod('tznew_animation_speed', 300);
    
    // Convert hex to RGB for opacity calculations
    $primary_rgb = tznew_hex_to_rgb($primary_color);
    $secondary_rgb = tznew_hex_to_rgb($secondary_color);
    $accent_rgb = tznew_hex_to_rgb($accent_color);
    
    $css = ':root {
';
    $css .= '--primary-color: ' . $primary_color . ';\n';
    $css .= '--primary-color-rgb: ' . implode(', ', $primary_rgb) . ';\n';
    $css .= '--primary-color-alpha: rgba(' . implode(', ', $primary_rgb) . ', ' . ($primary_opacity / 100) . ');\n';
    $css .= '--secondary-color: ' . $secondary_color . ';\n';
    $css .= '--secondary-color-rgb: ' . implode(', ', $secondary_rgb) . ';\n';
    $css .= '--secondary-color-alpha: rgba(' . implode(', ', $secondary_rgb) . ', ' . ($secondary_opacity / 100) . ');\n';
    $css .= '--accent-color: ' . $accent_color . ';\n';
    $css .= '--accent-color-rgb: ' . implode(', ', $accent_rgb) . ';\n';
    $css .= '--accent-color-alpha: rgba(' . implode(', ', $accent_rgb) . ', ' . ($accent_opacity / 100) . ');\n';
    $css .= '--text-dark: ' . $text_dark . ';\n';
    $css .= '--text-light: ' . $text_light . ';\n';
    $css .= '--bg-light: ' . $bg_light . ';\n';
    $css .= '--bg-white: ' . $bg_white . ';\n';
    $css .= '--border-color: ' . $border_color . ';\n';
    $css .= '--animation-speed: ' . $animation_speed . 'ms;\n';
    
    if ($enable_gradients) {
        $css .= '--gradient-primary: linear-gradient(' . $gradient_direction . ', ' . $gradient_start . ', ' . $gradient_end . ');\n';
        $css .= '--gradient-bg: linear-gradient(' . $gradient_direction . ', ' . $primary_color . ', ' . $secondary_color . ');\n';
    }
    
    $css .= '}\n';
    
    return $css;
}

/**
 * Convert hex color to RGB array
 */
function tznew_hex_to_rgb($hex) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    
    return array($r, $g, $b);
}

/**
 * Output customizer CSS
 */
function tznew_customizer_css() {
    echo '<style type="text/css" id="tznew-customizer-css">';
    echo tznew_generate_css_variables();
    echo '</style>';
}
add_action('wp_head', 'tznew_customizer_css');

/**
 * Enqueue customizer preview script
 */
function tznew_customize_preview_js() {
    wp_enqueue_script(
        'tznew-customizer-preview',
        TZNEW_THEME_URI . '/assets/js/customizer-preview.js',
        array('customize-preview'),
        TZNEW_VERSION,
        true
    );
}
add_action('customize_preview_init', 'tznew_customize_preview_js');

/**
 * Apply color presets
 */
function tznew_apply_color_preset($preset) {
    $presets = array(
        'sunset' => array(
            'primary' => '#f97316',
            'secondary' => '#ec4899',
            'accent' => '#fbbf24',
            'gradient_start' => '#f97316',
            'gradient_end' => '#ec4899',
        ),
        'ocean' => array(
            'primary' => '#0ea5e9',
            'secondary' => '#06b6d4',
            'accent' => '#3b82f6',
            'gradient_start' => '#0ea5e9',
            'gradient_end' => '#06b6d4',
        ),
        'forest' => array(
            'primary' => '#059669',
            'secondary' => '#92400e',
            'accent' => '#65a30d',
            'gradient_start' => '#059669',
            'gradient_end' => '#92400e',
        ),
        'purple' => array(
            'primary' => '#7c3aed',
            'secondary' => '#c026d3',
            'accent' => '#a855f7',
            'gradient_start' => '#7c3aed',
            'gradient_end' => '#c026d3',
        ),
        'monochrome' => array(
            'primary' => '#374151',
            'secondary' => '#6b7280',
            'accent' => '#9ca3af',
            'gradient_start' => '#374151',
            'gradient_end' => '#6b7280',
        ),
    );
    
    if (isset($presets[$preset])) {
        $colors = $presets[$preset];
        set_theme_mod('tznew_primary_color', $colors['primary']);
        set_theme_mod('tznew_secondary_color', $colors['secondary']);
        set_theme_mod('tznew_accent_color', $colors['accent']);
        set_theme_mod('tznew_gradient_start', $colors['gradient_start']);
        set_theme_mod('tznew_gradient_end', $colors['gradient_end']);
    }
}

/**
 * Handle preset changes via AJAX
 */
function tznew_handle_preset_change() {
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'tznew_nonce')) {
        wp_die('Security check failed');
    }
    
    $preset = sanitize_text_field($_POST['preset'] ?? '');
    
    if ($preset && $preset !== 'custom') {
        tznew_apply_color_preset($preset);
        wp_send_json_success('Preset applied successfully');
    }
    
    wp_send_json_error('Invalid preset');
}
add_action('wp_ajax_tznew_apply_preset', 'tznew_handle_preset_change');
add_action('wp_ajax_nopriv_tznew_apply_preset', 'tznew_handle_preset_change');