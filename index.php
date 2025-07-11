<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TZnew
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto py-8 px-4" style="opacity: 1 !important; visibility: visible !important; display: block !important;">

    <?php if ( have_posts() ) : ?>

        <header class="page-header mb-8" style="opacity: 1 !important; visibility: visible !important; display: block !important;">
            <?php
            if ( is_home() && ! is_front_page() ) :
                ?>
                <h1 class="page-title text-3xl font-bold mb-4"><?php single_post_title(); ?></h1>
                <?php
            else :
                ?>
                <h1 class="page-title text-3xl font-bold mb-4"><?php esc_html_e( 'Latest Posts', 'tznew' ); ?></h1>
                <?php
            endif;
            ?>
        </header><!-- .page-header -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" style="opacity: 1 !important; visibility: visible !important; display: grid !important;">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;
            ?>
        </div>

        <?php
        // Previous/next page navigation.
        tznew_pagination();

    else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>

</main><!-- #main -->

<script>
// Ultra-aggressive index page visibility enforcement
function forceIndexVisibility() {
	const selectors = [
		'#primary',
		'.site-main',
		'.container',
		'.grid',
		'.page-header',
		'article',
		'div',
		'main',
		'.bg-white',
		'.rounded-lg',
		'.shadow-md',
		'.overflow-hidden'
	];
	
	selectors.forEach(selector => {
		const elements = document.querySelectorAll(selector);
		elements.forEach(el => {
			el.style.setProperty('opacity', '1', 'important');
			el.style.setProperty('visibility', 'visible', 'important');
			el.style.setProperty('transform', 'none', 'important');
			el.style.setProperty('animation', 'none', 'important');
			if (el.tagName.toLowerCase() === 'div' || el.tagName.toLowerCase() === 'main' || el.tagName.toLowerCase() === 'header') {
				el.style.setProperty('display', 'block', 'important');
			}
			if (el.classList.contains('grid')) {
				el.style.setProperty('display', 'grid', 'important');
			}
		});
	});
}

// Execute immediately
forceIndexVisibility();

// Continuous enforcement every 100ms for first 5 seconds
let enforcementCount = 0;
const enforcementInterval = setInterval(() => {
	forceIndexVisibility();
	enforcementCount++;
	if (enforcementCount >= 50) { // 50 * 100ms = 5 seconds
		clearInterval(enforcementInterval);
	}
}, 100);

// Execute on DOM ready
document.addEventListener('DOMContentLoaded', function() {
	forceIndexVisibility();
});
</script>

<?php
get_sidebar();
get_footer();