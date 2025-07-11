<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TZnew
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<!-- Critical CSS for immediate content display -->
	<style>
		/* Ensure content is visible immediately - Aggressive approach */
		.site-content, .blog-content, .entry-content, .blog, .blog section, .blog .grid, .blog article, .blog .bg-white, .blog .rounded-lg, .blog .shadow-md {
			opacity: 1 !important;
			visibility: visible !important;
			display: block !important;
			transform: none !important;
			animation: none !important;
		}
		
		/* Override any Tailwind or external CSS that might hide content */
		.blog .grid > div, .blog .overflow-hidden {
			opacity: 1 !important;
			visibility: visible !important;
			transform: none !important;
		}
		
		/* Preloader optimization */
		.preloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(255, 255, 255, 0.95);
			z-index: 9999;
			transition: opacity 0.2s ease, visibility 0.2s ease;
		}
		
		.preloader.fade-out {
			opacity: 0;
			visibility: hidden;
		}
		
		/* Force immediate display */
		body {
			visibility: visible !important;
		}
	</style>
	
	<!-- Immediate content display script -->
	<script>
		// Execute immediately to prevent any buffering
		(function() {
			// Remove preloader immediately if it exists
			function forceRemovePreloader() {
				var preloader = document.querySelector('.preloader');
				if (preloader) {
					preloader.style.opacity = '0';
					preloader.style.visibility = 'hidden';
					setTimeout(function() {
						if (preloader.parentNode) {
							preloader.parentNode.removeChild(preloader);
						}
					}, 200);
				}
			}
			
			// Force content visibility
			function forceContentVisibility() {
				var elements = document.querySelectorAll('.site-content, .blog-content, .entry-content, body');
				for (var i = 0; i < elements.length; i++) {
					elements[i].style.opacity = '1';
					elements[i].style.visibility = 'visible';
					elements[i].style.display = 'block';
				}
			}
			
			// Execute on DOM ready
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', function() {
					forceRemovePreloader();
					forceContentVisibility();
				});
			} else {
				forceRemovePreloader();
				forceContentVisibility();
			}
			
			// Fallback timeout
			setTimeout(function() {
				forceRemovePreloader();
				forceContentVisibility();
			}, 100);
			
			// Ultra-aggressive blog content display
			function forceBlogVisibility() {
				var blogSelectors = [
					'.blog', '.blog section', '.blog .grid', '.blog article',
					'.blog .bg-white', '.blog .rounded-lg', '.blog .shadow-md',
					'.blog .overflow-hidden', '.blog .grid > div',
					'.blog-content', '.entry-content'
				];
				
				blogSelectors.forEach(function(selector) {
					var elements = document.querySelectorAll(selector);
					for (var i = 0; i < elements.length; i++) {
						elements[i].style.opacity = '1';
						elements[i].style.visibility = 'visible';
						elements[i].style.transform = 'none';
						elements[i].style.display = elements[i].tagName.toLowerCase() === 'div' ? 'block' : '';
						elements[i].style.animation = 'none';
					}
				});
			}
			
			// Run blog visibility immediately
			forceBlogVisibility();
			
			// Run again after DOM is ready
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', forceBlogVisibility);
			}
			
			// Run periodically to override any dynamic changes
			setInterval(forceBlogVisibility, 500);
		})();
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader - Optimized for fast loading -->
<div class="preloader">
	<!-- Spinner is handled by CSS ::after pseudo-element -->
</div>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'tznew' ); ?></a>

	<header id="masthead" class="site-header bg-white/95 backdrop-blur-md shadow-lg fixed w-full top-0 z-40 transition-all duration-300">
		<div class="container mx-auto px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="site-branding flex items-center animate-fade-in-left">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title text-2xl lg:text-3xl font-bold text-blue-800 hover:text-blue-600 transition-colors">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
							<?php
					else :
							?>
							<p class="site-title text-2xl lg:text-3xl font-bold text-blue-800 hover:text-blue-600 transition-colors">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</p>
							<?php
					endif;
					endif;
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation animate-fade-in-right">
					<button class="menu-toggle lg:hidden flex flex-col gap-1 p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle Menu">
						<span class="w-6 h-0.5 bg-gray-700 transition-all duration-300"></span>
						<span class="w-6 h-0.5 bg-gray-700 transition-all duration-300"></span>
						<span class="w-6 h-0.5 bg-gray-700 transition-all duration-300"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container_class' => 'primary-menu-container hidden lg:block',
							'menu_class'     => 'primary-menu flex items-center space-x-8',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<?php if (!is_front_page()): ?>
	<div class="breadcrumbs-container bg-gray-100 py-2">
		<div class="container mx-auto px-4">
			<?php tznew_breadcrumbs(); ?>
		</div>
	</div>
	<?php endif; ?>

	<div id="content" class="site-content pt-20">