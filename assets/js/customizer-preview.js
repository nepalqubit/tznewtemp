/**
 * Customizer Live Preview Script
 * Handles real-time updates in the customizer preview
 *
 * @package TZnew
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // Helper function to update CSS custom properties
    function updateCSSVariable(property, value) {
        document.documentElement.style.setProperty(property, value);
    }

    // Helper function to convert hex to RGB
    function hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    // Helper function to update color with opacity
    function updateColorWithOpacity(colorSetting, opacitySetting, cssVar) {
        wp.customize(colorSetting, function(value) {
            value.bind(function(newval) {
                const opacity = wp.customize(opacitySetting)() / 100;
                const rgb = hexToRgb(newval);
                if (rgb) {
                    updateCSSVariable(cssVar, newval);
                    updateCSSVariable(cssVar + '-rgb', `${rgb.r}, ${rgb.g}, ${rgb.b}`);
                    updateCSSVariable(cssVar + '-alpha', `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, ${opacity})`);
                }
            });
        });

        wp.customize(opacitySetting, function(value) {
            value.bind(function(newval) {
                const color = wp.customize(colorSetting)();
                const opacity = newval / 100;
                const rgb = hexToRgb(color);
                if (rgb) {
                    updateCSSVariable(cssVar + '-alpha', `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, ${opacity})`);
                }
            });
        });
    }

    // Primary Color with Opacity
    updateColorWithOpacity('tznew_primary_color', 'tznew_primary_opacity', '--primary-color');

    // Secondary Color with Opacity
    updateColorWithOpacity('tznew_secondary_color', 'tznew_secondary_opacity', '--secondary-color');

    // Accent Color with Opacity
    updateColorWithOpacity('tznew_accent_color', 'tznew_accent_opacity', '--accent-color');

    // Text Colors
    wp.customize('tznew_text_dark', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--text-dark', newval);
        });
    });

    wp.customize('tznew_text_light', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--text-light', newval);
        });
    });

    // Background Colors
    wp.customize('tznew_bg_light', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--bg-light', newval);
        });
    });

    wp.customize('tznew_bg_white', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--bg-white', newval);
        });
    });

    wp.customize('tznew_border_color', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--border-color', newval);
        });
    });

    // Animation Speed
    wp.customize('tznew_animation_speed', function(value) {
        value.bind(function(newval) {
            updateCSSVariable('--animation-speed', newval + 'ms');
        });
    });

    // Gradient Settings
    function updateGradients() {
        const enableGradients = wp.customize('tznew_enable_gradients')();
        const direction = wp.customize('tznew_gradient_direction')();
        const startColor = wp.customize('tznew_gradient_start')();
        const endColor = wp.customize('tznew_gradient_end')();
        const primaryColor = wp.customize('tznew_primary_color')();
        const secondaryColor = wp.customize('tznew_secondary_color')();

        if (enableGradients) {
            updateCSSVariable('--gradient-primary', `linear-gradient(${direction}, ${startColor}, ${endColor})`);
            updateCSSVariable('--gradient-bg', `linear-gradient(${direction}, ${primaryColor}, ${secondaryColor})`);
        } else {
            updateCSSVariable('--gradient-primary', 'none');
            updateCSSVariable('--gradient-bg', 'none');
        }
    }

    wp.customize('tznew_enable_gradients', function(value) {
        value.bind(updateGradients);
    });

    wp.customize('tznew_gradient_direction', function(value) {
        value.bind(updateGradients);
    });

    wp.customize('tznew_gradient_start', function(value) {
        value.bind(updateGradients);
    });

    wp.customize('tznew_gradient_end', function(value) {
        value.bind(updateGradients);
    });

    // Color Preset Handler
    wp.customize('tznew_color_preset', function(value) {
        value.bind(function(newval) {
            if (newval !== 'custom') {
                // Apply preset colors
                const presets = {
                    'default': {
                        primary: '#2563eb',
                        secondary: '#059669',
                        accent: '#f59e0b',
                        gradient_start: '#2563eb',
                        gradient_end: '#059669'
                    },
                    'sunset': {
                        primary: '#f97316',
                        secondary: '#ec4899',
                        accent: '#fbbf24',
                        gradient_start: '#f97316',
                        gradient_end: '#ec4899'
                    },
                    'ocean': {
                        primary: '#0ea5e9',
                        secondary: '#06b6d4',
                        accent: '#3b82f6',
                        gradient_start: '#0ea5e9',
                        gradient_end: '#06b6d4'
                    },
                    'forest': {
                        primary: '#059669',
                        secondary: '#92400e',
                        accent: '#65a30d',
                        gradient_start: '#059669',
                        gradient_end: '#92400e'
                    },
                    'purple': {
                        primary: '#7c3aed',
                        secondary: '#c026d3',
                        accent: '#a855f7',
                        gradient_start: '#7c3aed',
                        gradient_end: '#c026d3'
                    },
                    'monochrome': {
                        primary: '#374151',
                        secondary: '#6b7280',
                        accent: '#9ca3af',
                        gradient_start: '#374151',
                        gradient_end: '#6b7280'
                    }
                };

                if (presets[newval]) {
                    const colors = presets[newval];
                    
                    // Update customizer controls
                    wp.customize('tznew_primary_color').set(colors.primary);
                    wp.customize('tznew_secondary_color').set(colors.secondary);
                    wp.customize('tznew_accent_color').set(colors.accent);
                    wp.customize('tznew_gradient_start').set(colors.gradient_start);
                    wp.customize('tznew_gradient_end').set(colors.gradient_end);
                }
            }
        });
    });

    // Dark Mode Toggle
    wp.customize('tznew_dark_mode', function(value) {
        value.bind(function(newval) {
            if (newval) {
                document.documentElement.classList.add('dark-mode');
                // Update colors for dark mode
                updateCSSVariable('--text-dark', '#f9fafb');
                updateCSSVariable('--text-light', '#d1d5db');
                updateCSSVariable('--bg-light', '#1f2937');
                updateCSSVariable('--bg-white', '#111827');
                updateCSSVariable('--border-color', '#374151');
            } else {
                document.documentElement.classList.remove('dark-mode');
                // Restore light mode colors
                updateCSSVariable('--text-dark', wp.customize('tznew_text_dark')());
                updateCSSVariable('--text-light', wp.customize('tznew_text_light')());
                updateCSSVariable('--bg-light', wp.customize('tznew_bg_light')());
                updateCSSVariable('--bg-white', wp.customize('tznew_bg_white')());
                updateCSSVariable('--border-color', wp.customize('tznew_border_color')());
            }
        });
    });

    // Add smooth transitions for color changes
    function addColorTransitions() {
        const style = document.createElement('style');
        style.textContent = `
            * {
                transition: color var(--animation-speed, 300ms) ease,
                           background-color var(--animation-speed, 300ms) ease,
                           border-color var(--animation-speed, 300ms) ease,
                           box-shadow var(--animation-speed, 300ms) ease !important;
            }
        `;
        document.head.appendChild(style);
    }

    // Initialize transitions when preview loads
    $(document).ready(function() {
        addColorTransitions();
    });

    // Update elements that use specific classes or attributes
    function updateThemeElements() {
        // Update buttons
        $('.btn-primary, .button-primary').each(function() {
            $(this).css({
                'background-color': 'var(--primary-color)',
                'border-color': 'var(--primary-color)'
            });
        });

        $('.btn-secondary, .button-secondary').each(function() {
            $(this).css({
                'background-color': 'var(--secondary-color)',
                'border-color': 'var(--secondary-color)'
            });
        });

        // Update links
        $('a:not(.btn):not(.button)').each(function() {
            $(this).css('color', 'var(--primary-color)');
        });

        // Update headings
        $('h1, h2, h3, h4, h5, h6').each(function() {
            $(this).css('color', 'var(--text-dark)');
        });

        // Update text elements
        $('p, span, div').each(function() {
            if (!$(this).hasClass('btn') && !$(this).hasClass('button')) {
                $(this).css('color', 'var(--text-light)');
            }
        });
    }

    // Apply theme updates when colors change
    wp.customize.bind('ready', function() {
        updateThemeElements();
    });

    // Re-apply theme updates when any color setting changes
    const colorSettings = [
        'tznew_primary_color', 'tznew_secondary_color', 'tznew_accent_color',
        'tznew_text_dark', 'tznew_text_light', 'tznew_bg_light', 'tznew_bg_white'
    ];

    colorSettings.forEach(function(setting) {
        wp.customize(setting, function(value) {
            value.bind(function() {
                setTimeout(updateThemeElements, 100);
            });
        });
    });

})(jQuery);