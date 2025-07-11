<?php
/**
 * The template for displaying single tours posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TZnew
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		
		<!-- Hero Section -->
		<section class="relative h-96 md:h-[500px] overflow-hidden">
			<?php if (has_post_thumbnail()) : ?>
				<div class="absolute inset-0">
					<?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
				</div>
				<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
			<?php else : ?>
				<div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800"></div>
			<?php endif; ?>
			
			<div class="relative z-10 container mx-auto px-4 h-full flex items-end pb-12">
				<div class="text-white max-w-4xl">
					<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
						<?php the_title(); ?>
					</h1>
					
					<?php if (function_exists('tznew_get_field_safe')) : ?>
						<?php $overview = tznew_get_field_safe('overview', get_the_ID()); ?>
						<?php if (!empty($overview)) : ?>
							<p class="text-lg md:text-xl text-blue-100 leading-relaxed">
								<?php echo esc_html(wp_trim_words($overview, 30)); ?>
							</p>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>
		
		<!-- Content Section -->
		<div class="container mx-auto px-4 py-12">
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
				<!-- Main Content -->
				<div class="lg:col-span-2">
					<?php get_template_part('template-parts/content', 'tours'); ?>
				</div>
				
				<!-- Sidebar -->
				<div class="lg:col-span-1">
					<div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
						<h3 class="text-xl font-bold mb-4 text-gray-800"><?php esc_html_e('Tour Information', 'tznew'); ?></h3>
						
						<?php if (function_exists('tznew_get_field_safe')) : ?>
							<!-- Duration -->
							<?php $duration = tznew_get_field_safe('duration', get_the_ID()); ?>
							<?php if (!empty($duration)) : ?>
								<div class="flex items-center mb-3 pb-3 border-b border-gray-200">
									<i class="fas fa-clock text-blue-600 mr-3"></i>
									<div>
										<span class="text-sm text-gray-600"><?php esc_html_e('Duration', 'tznew'); ?></span>
										<p class="font-semibold text-gray-800"><?php echo esc_html($duration); ?> <?php echo _n('Day', 'Days', $duration, 'tznew'); ?></p>
									</div>
								</div>
							<?php endif; ?>
							
							<!-- Tour Type -->
							<?php $tour_type = tznew_get_field_safe('tour_type', get_the_ID()); ?>
							<?php if (!empty($tour_type)) : ?>
								<div class="flex items-center mb-3 pb-3 border-b border-gray-200">
									<i class="fas fa-tag text-blue-600 mr-3"></i>
									<div>
										<span class="text-sm text-gray-600"><?php esc_html_e('Tour Type', 'tznew'); ?></span>
										<p class="font-semibold text-gray-800"><?php echo esc_html(ucfirst($tour_type)); ?></p>
									</div>
								</div>
							<?php endif; ?>
							
							<!-- Region -->
							<?php $region = tznew_get_field_safe('region', get_the_ID()); ?>
							<?php if (!empty($region)) : ?>
								<div class="flex items-center mb-3 pb-3 border-b border-gray-200">
									<i class="fas fa-location-dot text-blue-600 mr-3"></i>
									<div>
										<span class="text-sm text-gray-600"><?php esc_html_e('Region', 'tznew'); ?></span>
										<p class="font-semibold text-gray-800"><?php echo esc_html($region); ?></p>
									</div>
								</div>
							<?php endif; ?>
							
							<!-- Price -->
							<?php $price = tznew_get_field_safe('price', get_the_ID()); ?>
							<?php if (!empty($price)) : ?>
								<div class="flex items-center mb-4">
									<i class="fas fa-dollar-sign text-green-600 mr-3"></i>
									<div>
										<span class="text-sm text-gray-600"><?php esc_html_e('Starting Price', 'tznew'); ?></span>
										<p class="font-bold text-green-600 text-lg">$<?php echo esc_html($price); ?></p>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						
						<!-- Action Buttons -->
						<div class="space-y-3 mt-6">
							<!-- Primary Booking Button -->
							<div>
								<a href="<?php echo esc_url(home_url('/booking')); ?>?tour_id=<?php echo get_the_ID(); ?>" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center">
									<i class="fas fa-calendar-check mr-2"></i>
									<?php esc_html_e('Book This Tour', 'tznew'); ?>
								</a>
							</div>
							
							<!-- Customization Button -->
							<div>
								<button onclick="openCustomizationModal(<?php echo get_the_ID(); ?>)" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center">
									<i class="fas fa-magic mr-2"></i>
									<?php esc_html_e('Customize This Trip', 'tznew'); ?>
								</button>
							</div>
							
							<!-- Inquiry Button -->
							<div>
								<button onclick="openInquiryModal(<?php echo get_the_ID(); ?>)" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center border border-gray-300">
									<i class="fas fa-envelope mr-2"></i>
									<?php esc_html_e('Send Inquiry', 'tznew'); ?>
								</button>
							</div>
						</div>
						
						<!-- Quick Contact Info -->
						<div class="mt-6 pt-6 border-t border-gray-200">
							<h4 class="text-sm font-semibold text-gray-800 mb-3"><?php esc_html_e('Need Help?', 'tznew'); ?></h4>
							<div class="space-y-2 text-sm">
								<a href="tel:+977-1-4123456" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
									<i class="fas fa-phone w-4 mr-2"></i>
									<span>+977-1-4123456</span>
								</a>
								<a href="mailto:info@dragonholidays.com" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
									<i class="fas fa-envelope w-4 mr-2"></i>
									<span>info@dragonholidays.com</span>
								</a>
								<a href="https://wa.me/9771234567890" class="flex items-center text-gray-600 hover:text-green-600 transition-colors">
									<i class="fab fa-whatsapp w-4 mr-2"></i>
									<span><?php esc_html_e('WhatsApp Chat', 'tznew'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
		// Display FAQ section
		tznew_display_faqs();
		?>
		
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		
	endwhile; // End of the loop.
	?>
</main>

<!-- Inquiry Modal -->
<div id="inquiry-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
	<div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
		<div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center rounded-t-2xl">
			<h3 class="text-xl font-bold text-gray-800"><?php esc_html_e('Send Inquiry', 'tznew'); ?></h3>
			<button onclick="closeInquiryModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="p-6">
			<?php get_template_part('template-parts/inquiry-form'); ?>
		</div>
	</div>
</div>

<!-- Customization Modal -->
<div id="customization-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
	<div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
		<div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center rounded-t-2xl">
			<h3 class="text-xl font-bold text-gray-800"><?php esc_html_e('Customize Your Trip', 'tznew'); ?></h3>
			<button onclick="closeCustomizationModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="p-6">
			<?php get_template_part('template-parts/customization-form'); ?>
		</div>
	</div>
</div>

<?php
get_sidebar();
get_footer();