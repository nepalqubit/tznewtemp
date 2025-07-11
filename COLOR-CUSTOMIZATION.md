# Theme Color Customization System

This document outlines the comprehensive color customization system implemented in the TZnew theme.

## Overview

The theme now includes a powerful color customization system that allows users to:
- Change primary, secondary, and accent colors
- Adjust color opacity for each color
- Enable/disable gradient effects
- Choose gradient directions
- Apply pre-built color scheme presets
- Enable dark mode support
- Control animation speeds

## Files Added/Modified

### New Files
1. **`/inc/customizer.php`** - Main customizer functionality
2. **`/assets/js/customizer-preview.js`** - Live preview JavaScript
3. **`/page-color-demo.php`** - Demo page template
4. **`/COLOR-CUSTOMIZATION.md`** - This documentation

### Modified Files
1. **`/functions.php`** - Added customizer include
2. **`/assets/css/custom.css`** - Enhanced CSS variables and utility classes

## Customizer Sections

### 1. Primary Colors
- **Primary Color**: Main theme color with opacity control
- **Secondary Color**: Secondary theme color with opacity control  
- **Accent Color**: Accent/highlight color with opacity control

### 2. Gradient Settings
- **Enable Gradients**: Toggle gradient effects on/off
- **Gradient Direction**: Choose from 8 directions (to-t, to-tr, to-r, to-br, to-b, to-bl, to-l, to-tl)
- **Gradient Start Color**: Starting color for gradients
- **Gradient End Color**: Ending color for gradients

### 3. Text Colors
- **Dark Text Color**: For headings and primary text
- **Light Text Color**: For secondary text and descriptions

### 4. Background Colors
- **Light Background**: Light background sections
- **White Background**: Pure white backgrounds
- **Border Color**: Border and divider colors

### 5. Advanced Settings
- **Color Scheme Presets**: Pre-built color combinations
  - Default (Blue & Green)
  - Sunset (Orange & Pink)
  - Ocean (Blue & Teal)
  - Forest (Green & Brown)
  - Purple (Purple & Violet)
  - Monochrome (Gray scale)
  - Custom (User-defined)
- **Dark Mode Support**: Toggle dark mode compatibility
- **Animation Speed**: Control transition speeds (100ms - 1000ms)

## CSS Custom Properties

The system generates the following CSS custom properties:

```css
:root {
  /* Base Colors */
  --primary-color: #2563eb;
  --primary-color-rgb: 37, 99, 235;
  --primary-color-alpha: rgba(37, 99, 235, 1);
  --secondary-color: #059669;
  --secondary-color-rgb: 5, 150, 105;
  --secondary-color-alpha: rgba(5, 150, 105, 1);
  --accent-color: #f59e0b;
  --accent-color-rgb: 245, 158, 11;
  --accent-color-alpha: rgba(245, 158, 11, 1);
  
  /* Text Colors */
  --text-dark: #1f2937;
  --text-light: #6b7280;
  
  /* Background Colors */
  --bg-light: #f9fafb;
  --bg-white: #ffffff;
  --border-color: #e5e7eb;
  
  /* Effects */
  --animation-speed: 300ms;
  --gradient-primary: linear-gradient(to-br, var(--primary-color), var(--secondary-color));
  --gradient-bg: linear-gradient(to-br, var(--primary-color), var(--secondary-color));
}
```

## Utility Classes

### Basic Color Classes
```css
.text-primary { color: var(--primary-color); }
.text-secondary { color: var(--secondary-color); }
.text-accent { color: var(--accent-color); }
.bg-primary { background-color: var(--primary-color); }
.bg-secondary { background-color: var(--secondary-color); }
.bg-accent { background-color: var(--accent-color); }
.border-primary { border-color: var(--primary-color); }
```

### Gradient Classes
```css
.bg-gradient-primary { background: var(--gradient-primary); }
.bg-gradient-bg { background: var(--gradient-bg); }
```

### Opacity Variants
```css
.bg-primary-alpha { background-color: var(--primary-color-alpha); }
.bg-secondary-alpha { background-color: var(--secondary-color-alpha); }
.bg-accent-alpha { background-color: var(--accent-color-alpha); }
```

### Enhanced Button Class
```css
.btn-gradient {
  background: var(--gradient-primary);
  /* Includes hover effects with secondary gradient */
}
```

## Usage Examples

### In PHP Templates
```php
<!-- Using utility classes -->
<div class="bg-primary text-white p-4">
  <h2 class="text-accent">Themed Content</h2>
</div>

<!-- Using gradient backgrounds -->
<section class="bg-gradient-primary text-white">
  <h1>Hero Section</h1>
</section>
```

### In CSS
```css
/* Using CSS custom properties */
.custom-element {
  background-color: var(--primary-color-alpha);
  border: 2px solid var(--secondary-color);
  color: var(--text-dark);
  transition: var(--transition);
}

.custom-element:hover {
  background: var(--gradient-primary);
}
```

### In JavaScript
```javascript
// Accessing CSS custom properties
const primaryColor = getComputedStyle(document.documentElement)
  .getPropertyValue('--primary-color');

// Setting CSS custom properties
document.documentElement.style
  .setProperty('--primary-color', '#ff0000');
```

## Live Preview Features

The customizer includes live preview functionality:
- Real-time color updates without page refresh
- Smooth transitions between color changes
- Automatic gradient updates
- Preset application with live preview
- Dark mode toggle with instant feedback

## Color Preset System

Built-in presets automatically apply coordinated color schemes:

1. **Default**: Blue (#2563eb) & Green (#059669)
2. **Sunset**: Orange (#f97316) & Pink (#ec4899)
3. **Ocean**: Sky Blue (#0ea5e9) & Teal (#06b6d4)
4. **Forest**: Green (#059669) & Brown (#92400e)
5. **Purple**: Purple (#7c3aed) & Magenta (#c026d3)
6. **Monochrome**: Gray scale variants

## Best Practices

### For Developers
1. Always use CSS custom properties instead of hardcoded colors
2. Utilize the provided utility classes when possible
3. Test color combinations for accessibility
4. Use the alpha variants for overlay effects
5. Implement smooth transitions using `var(--transition)`

### For Users
1. Test color combinations in different lighting conditions
2. Ensure sufficient contrast for accessibility
3. Use presets as starting points for custom schemes
4. Preview changes on different page types
5. Consider your brand colors when customizing

## Accessibility Considerations

- All color combinations should meet WCAG 2.1 AA contrast requirements
- The system provides both light and dark text options
- Opacity controls help create subtle, accessible overlays
- Dark mode support improves accessibility for light-sensitive users

## Browser Support

- CSS Custom Properties: All modern browsers (IE 11+ with fallbacks)
- CSS Gradients: All modern browsers
- Live Preview: Requires JavaScript enabled

## Troubleshooting

### Common Issues
1. **Colors not updating**: Check if customizer.php is properly included
2. **JavaScript errors**: Ensure customizer-preview.js is enqueued
3. **Gradients not working**: Verify gradient settings are enabled
4. **Preset not applying**: Check AJAX functionality and nonce verification

### Debug Mode
Add this to wp-config.php for debugging:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Future Enhancements

Potential improvements for future versions:
- Color palette generator based on single color input
- Advanced gradient controls (radial, conic)
- Color harmony suggestions
- Export/import color schemes
- Integration with brand color APIs
- Automatic dark mode color generation

## Support

For issues or questions regarding the color customization system:
1. Check this documentation first
2. Review the demo page for usage examples
3. Test with default settings to isolate issues
4. Check browser console for JavaScript errors

---

*Last updated: December 2024*
*Version: 1.0.0*