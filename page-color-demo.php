<?php
/**
 * Template Name: Color Customization Demo
 * 
 * A demo page to showcase the theme's color customization features
 *
 * @package TZnew
 * @version 1.0.0
 */

get_header(); ?>

<div class="color-demo-page">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Hero Section with Gradient Background -->
        <section class="bg-gradient-primary text-white rounded-lg p-8 mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Color Customization Demo</h1>
                <p class="text-xl mb-6">Experience the power of dynamic color theming with gradients and opacity controls</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <button class="btn btn-gradient px-6 py-3 rounded-lg font-semibold">Gradient Button</button>
                    <button class="bg-accent-alpha text-white px-6 py-3 rounded-lg font-semibold">Alpha Button</button>
                </div>
            </div>
        </section>

        <!-- Color Palette Display -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-6">Current Color Palette</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Primary Colors -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-dark mb-4">Primary Colors</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-primary rounded-lg"></div>
                            <div>
                                <p class="font-medium text-dark">Primary</p>
                                <p class="text-sm text-light">var(--primary-color)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-primary-alpha rounded-lg"></div>
                            <div>
                                <p class="font-medium text-dark">Primary Alpha</p>
                                <p class="text-sm text-light">var(--primary-color-alpha)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secondary Colors -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-dark mb-4">Secondary Colors</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-secondary rounded-lg"></div>
                            <div>
                                <p class="font-medium text-dark">Secondary</p>
                                <p class="text-sm text-light">var(--secondary-color)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-secondary-alpha rounded-lg"></div>
                            <div>
                                <p class="font-medium text-dark">Secondary Alpha</p>
                                <p class="text-sm text-light">var(--secondary-color-alpha)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accent Colors -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-dark mb-4">Accent Colors</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-accent rounded-lg"></div>
                            <div>
                                <p class="font-medium text-dark">Accent</p>
                                <p class="text-sm text-light">var(--accent-color)</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-accent-alpha rounded-lg"></div>
                            <div>
                                <p class="font-medium text-dark">Accent Alpha</p>
                                <p class="text-sm text-light">var(--accent-color-alpha)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gradient Showcase -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-6">Gradient Effects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-primary text-white rounded-lg p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">Primary Gradient</h3>
                    <p>Dynamic gradient using customizer colors</p>
                </div>
                <div class="bg-gradient-bg text-white rounded-lg p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">Background Gradient</h3>
                    <p>Adaptive gradient background</p>
                </div>
            </div>
        </section>

        <!-- Interactive Elements -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-6">Interactive Elements</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button class="bg-primary text-white px-4 py-2 rounded hover:opacity-80 transition-all">Primary Button</button>
                    <button class="bg-secondary text-white px-4 py-2 rounded hover:opacity-80 transition-all">Secondary Button</button>
                    <button class="bg-accent text-white px-4 py-2 rounded hover:opacity-80 transition-all">Accent Button</button>
                    <button class="btn-gradient px-4 py-2 rounded">Gradient Button</button>
                </div>
                
                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-dark mb-3">Form Elements</h4>
                    <div class="space-y-4">
                        <input type="text" placeholder="Primary themed input" class="w-full px-4 py-2 border-2 border-primary rounded focus:outline-none focus:border-secondary">
                        <textarea placeholder="Textarea with theme colors" class="w-full px-4 py-2 border-2 border-secondary rounded focus:outline-none focus:border-accent" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </section>

        <!-- Typography Showcase -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-primary mb-6">Typography with Theme Colors</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-4xl font-bold text-dark mb-2">Heading 1 - Dark Text</h1>
                <h2 class="text-3xl font-semibold text-primary mb-2">Heading 2 - Primary Color</h2>
                <h3 class="text-2xl font-medium text-secondary mb-2">Heading 3 - Secondary Color</h3>
                <h4 class="text-xl text-accent mb-4">Heading 4 - Accent Color</h4>
                
                <p class="text-light mb-4">
                    This is a paragraph using the light text color. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                
                <p class="text-dark">
                    This paragraph uses the dark text color for better contrast and readability. 
                    <a href="#" class="text-primary hover:text-secondary transition-colors">This is a themed link</a> 
                    that changes color on hover.
                </p>
            </div>
        </section>

        <!-- Customization Instructions -->
        <section class="bg-light rounded-lg p-6">
            <h2 class="text-3xl font-bold text-primary mb-4">How to Customize</h2>
            <div class="prose max-w-none">
                <ol class="text-dark space-y-2">
                    <li><strong>Access the Customizer:</strong> Go to Appearance → Customize in your WordPress admin</li>
                    <li><strong>Find Color Scheme:</strong> Look for the "Color Scheme" panel in the customizer</li>
                    <li><strong>Choose Colors:</strong> Select your preferred colors for primary, secondary, and accent</li>
                    <li><strong>Adjust Opacity:</strong> Use the opacity sliders to create transparent effects</li>
                    <li><strong>Enable Gradients:</strong> Toggle gradient effects and choose direction</li>
                    <li><strong>Try Presets:</strong> Use built-in color scheme presets for quick styling</li>
                    <li><strong>Preview Live:</strong> See changes in real-time as you customize</li>
                </ol>
                
                <div class="mt-6 p-4 bg-primary-alpha rounded-lg">
                    <p class="text-dark font-medium">
                        💡 <strong>Pro Tip:</strong> All changes are applied using CSS custom properties, 
                        ensuring consistent theming across your entire website with smooth transitions.
                    </p>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
/* Demo-specific styles */
.color-demo-page {
    min-height: 100vh;
    background: var(--bg-light);
}

.color-demo-page .container {
    max-width: 1200px;
}

/* Enhanced button hover effects */
.color-demo-page button {
    transition: var(--transition);
    cursor: pointer;
}

.color-demo-page button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Form styling */
.color-demo-page input,
.color-demo-page textarea {
    transition: var(--transition);
}

.color-demo-page input:focus,
.color-demo-page textarea:focus {
    box-shadow: 0 0 0 3px var(--primary-color-alpha);
}

/* Link styling */
.color-demo-page a {
    transition: var(--transition);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .color-demo-page .grid {
        grid-template-columns: 1fr;
    }
    
    .color-demo-page .flex {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>