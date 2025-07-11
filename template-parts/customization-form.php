<?php
/**
 * Trip Customization Form Template
 *
 * @package TZnew
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get post data if available
$post_id = get_the_ID();
$post_title = get_the_title();
$post_type = get_post_type();
?>

<div class="customization-form-container bg-white rounded-2xl shadow-xl p-8 max-w-3xl mx-auto">
    <div class="form-header text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
            <i class="fas fa-magic text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2"><?php esc_html_e('Customize Your Trip', 'tznew'); ?></h2>
        <?php if ($post_title) : ?>
            <p class="text-lg text-gray-600"><?php esc_html_e('Based on:', 'tznew'); ?> <?php echo esc_html($post_title); ?></p>
        <?php else : ?>
            <p class="text-lg text-gray-600"><?php esc_html_e('Tell us your dream adventure and we\'ll make it happen', 'tznew'); ?></p>
        <?php endif; ?>
    </div>

    <form id="customization-form" class="customization-form space-y-6" method="post" novalidate>
        <?php wp_nonce_field('tznew_customization_nonce', 'customization_nonce'); ?>
        
        <!-- Hidden fields -->
        <input type="hidden" name="action" value="tznew_submit_customization">
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
        <input type="hidden" name="post_title" value="<?php echo esc_attr($post_title); ?>">
        <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
        <?php wp_nonce_field('tznew_customization_nonce', 'customization_nonce'); ?>

        <!-- Contact Information -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user mr-2 text-purple-500"></i>
                <?php esc_html_e('Your Information', 'tznew'); ?>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="custom_name" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Full Name', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="custom_name" name="custom_name" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="form-group">
                    <label for="custom_email" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Email Address', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="custom_email" name="custom_email" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="form-group">
                    <label for="custom_phone" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Phone Number', 'tznew'); ?>
                    </label>
                    <input type="tel" id="custom_phone" name="custom_phone" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                </div>
                
                <div class="form-group">
                    <label for="custom_country" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Country', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <select id="custom_country" name="custom_country" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" required>
                        <option value=""><?php esc_html_e('Select your country', 'tznew'); ?></option>
                        <option value="US"><?php esc_html_e('United States', 'tznew'); ?></option>
                        <option value="UK"><?php esc_html_e('United Kingdom', 'tznew'); ?></option>
                        <option value="CA"><?php esc_html_e('Canada', 'tznew'); ?></option>
                        <option value="AU"><?php esc_html_e('Australia', 'tznew'); ?></option>
                        <option value="DE"><?php esc_html_e('Germany', 'tznew'); ?></option>
                        <option value="FR"><?php esc_html_e('France', 'tznew'); ?></option>
                        <option value="JP"><?php esc_html_e('Japan', 'tznew'); ?></option>
                        <option value="IN"><?php esc_html_e('India', 'tznew'); ?></option>
                        <option value="NP"><?php esc_html_e('Nepal', 'tznew'); ?></option>
                        <option value="other"><?php esc_html_e('Other', 'tznew'); ?></option>
                    </select>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
        </div>

        <!-- Trip Customization Details -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-route mr-2 text-blue-500"></i>
                <?php esc_html_e('Trip Customization', 'tznew'); ?>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="trip_duration" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Preferred Duration', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <select id="trip_duration" name="trip_duration" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" required>
                        <option value=""><?php esc_html_e('Select duration', 'tznew'); ?></option>
                        <option value="1-3"><?php esc_html_e('1-3 days', 'tznew'); ?></option>
                        <option value="4-7"><?php esc_html_e('4-7 days', 'tznew'); ?></option>
                        <option value="8-14"><?php esc_html_e('8-14 days', 'tznew'); ?></option>
                        <option value="15-21"><?php esc_html_e('15-21 days', 'tznew'); ?></option>
                        <option value="22-30"><?php esc_html_e('22-30 days', 'tznew'); ?></option>
                        <option value="30+"><?php esc_html_e('More than 30 days', 'tznew'); ?></option>
                        <option value="flexible"><?php esc_html_e('Flexible', 'tznew'); ?></option>
                    </select>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="form-group">
                    <label for="group_size_custom" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Group Size', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <select id="group_size_custom" name="group_size_custom" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" required>
                        <option value=""><?php esc_html_e('Select group size', 'tznew'); ?></option>
                        <?php for ($i = 1; $i <= 20; $i++) : ?>
                            <option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($i . ($i === 1 ? ' person' : ' people')); ?></option>
                        <?php endfor; ?>
                        <option value="20+"><?php esc_html_e('More than 20 people', 'tznew'); ?></option>
                    </select>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="form-group">
                    <label for="preferred_season" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Preferred Season', 'tznew'); ?>
                    </label>
                    <select id="preferred_season" name="preferred_season" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <option value=""><?php esc_html_e('Any season', 'tznew'); ?></option>
                        <option value="spring"><?php esc_html_e('Spring (March-May)', 'tznew'); ?></option>
                        <option value="summer"><?php esc_html_e('Summer (June-August)', 'tznew'); ?></option>
                        <option value="autumn"><?php esc_html_e('Autumn (September-November)', 'tznew'); ?></option>
                        <option value="winter"><?php esc_html_e('Winter (December-February)', 'tznew'); ?></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="budget_range_custom" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Budget Range (per person)', 'tznew'); ?>
                    </label>
                    <select id="budget_range_custom" name="budget_range_custom" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <option value=""><?php esc_html_e('Select budget range', 'tznew'); ?></option>
                        <option value="under-500"><?php esc_html_e('Under $500', 'tznew'); ?></option>
                        <option value="500-1000"><?php esc_html_e('$500 - $1,000', 'tznew'); ?></option>
                        <option value="1000-2000"><?php esc_html_e('$1,000 - $2,000', 'tznew'); ?></option>
                        <option value="2000-3000"><?php esc_html_e('$2,000 - $3,000', 'tznew'); ?></option>
                        <option value="3000-5000"><?php esc_html_e('$3,000 - $5,000', 'tznew'); ?></option>
                        <option value="over-5000"><?php esc_html_e('Over $5,000', 'tznew'); ?></option>
                        <option value="flexible"><?php esc_html_e('Flexible', 'tznew'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Activity Preferences -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-hiking mr-2 text-green-500"></i>
                <?php esc_html_e('Activity Preferences', 'tznew'); ?>
            </h3>
            
            <div class="form-group">
                <label class="form-label block text-sm font-medium text-gray-700 mb-3">
                    <?php esc_html_e('What activities interest you? (Select all that apply)', 'tznew'); ?>
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="trekking" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Trekking', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="mountaineering" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Mountaineering', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="cultural-tours" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Cultural Tours', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="wildlife-safari" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Wildlife Safari', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="adventure-sports" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Adventure Sports', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="photography" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Photography', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="spiritual-journey" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Spiritual Journey', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="luxury-travel" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Luxury Travel', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="activities[]" value="other" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Other', 'tznew'); ?></span>
                    </label>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label for="difficulty_preference" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Preferred Difficulty Level', 'tznew'); ?>
                </label>
                <select id="difficulty_preference" name="difficulty_preference" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                    <option value=""><?php esc_html_e('Any difficulty', 'tznew'); ?></option>
                    <option value="easy"><?php esc_html_e('Easy - Suitable for beginners', 'tznew'); ?></option>
                    <option value="moderate"><?php esc_html_e('Moderate - Some experience required', 'tznew'); ?></option>
                    <option value="challenging"><?php esc_html_e('Challenging - Good fitness required', 'tznew'); ?></option>
                    <option value="extreme"><?php esc_html_e('Extreme - Expert level', 'tznew'); ?></option>
                </select>
            </div>
        </div>

        <!-- Accommodation & Services -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bed mr-2 text-indigo-500"></i>
                <?php esc_html_e('Accommodation & Services', 'tznew'); ?>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="accommodation_type" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Accommodation Preference', 'tznew'); ?>
                    </label>
                    <select id="accommodation_type" name="accommodation_type" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <option value=""><?php esc_html_e('No preference', 'tznew'); ?></option>
                        <option value="budget"><?php esc_html_e('Budget (Tea houses/Basic lodges)', 'tznew'); ?></option>
                        <option value="standard"><?php esc_html_e('Standard (Comfortable lodges)', 'tznew'); ?></option>
                        <option value="luxury"><?php esc_html_e('Luxury (Premium hotels/lodges)', 'tznew'); ?></option>
                        <option value="camping"><?php esc_html_e('Camping/Tented accommodation', 'tznew'); ?></option>
                        <option value="mixed"><?php esc_html_e('Mixed (Variety of options)', 'tznew'); ?></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="meal_preference" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Meal Preference', 'tznew'); ?>
                    </label>
                    <select id="meal_preference" name="meal_preference" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <option value=""><?php esc_html_e('Standard meals', 'tznew'); ?></option>
                        <option value="vegetarian"><?php esc_html_e('Vegetarian', 'tznew'); ?></option>
                        <option value="vegan"><?php esc_html_e('Vegan', 'tznew'); ?></option>
                        <option value="halal"><?php esc_html_e('Halal', 'tznew'); ?></option>
                        <option value="gluten-free"><?php esc_html_e('Gluten-free', 'tznew'); ?></option>
                        <option value="local-cuisine"><?php esc_html_e('Local cuisine focus', 'tznew'); ?></option>
                        <option value="international"><?php esc_html_e('International cuisine', 'tznew'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label class="form-label block text-sm font-medium text-gray-700 mb-3">
                    <?php esc_html_e('Additional Services (Select all that apply)', 'tznew'); ?>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="services[]" value="guide" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Professional Guide', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="services[]" value="porter" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Porter Service', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="services[]" value="equipment" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Equipment Rental', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="services[]" value="permits" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Permit Arrangements', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="services[]" value="transportation" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Transportation', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="services[]" value="insurance" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Travel Insurance', 'tznew'); ?></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Special Requirements -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-heart mr-2 text-red-500"></i>
                <?php esc_html_e('Special Requirements & Preferences', 'tznew'); ?>
            </h3>
            
            <div class="form-group">
                <label for="special_requirements" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Special Requirements or Accessibility Needs', 'tznew'); ?>
                </label>
                <textarea id="special_requirements" name="special_requirements" rows="3" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="<?php esc_attr_e('Please mention any medical conditions, physical limitations, or special assistance needed...', 'tznew'); ?>"></textarea>
            </div>
            
            <div class="form-group mt-4">
                <label for="custom_requests" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Detailed Trip Description & Custom Requests', 'tznew'); ?> <span class="text-red-500">*</span>
                </label>
                <textarea id="custom_requests" name="custom_requests" rows="6" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" placeholder="<?php esc_attr_e('Describe your dream trip in detail. What specific experiences are you looking for? Any particular places you want to visit? Special occasions to celebrate? The more details you provide, the better we can customize your perfect adventure...', 'tznew'); ?>" required></textarea>
                <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                <div class="text-sm text-gray-500 mt-1">
                    <?php esc_html_e('Minimum 20 characters required', 'tznew'); ?>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-submit pt-6">
            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center space-x-2">
                <i class="fas fa-magic"></i>
                <span><?php esc_html_e('Create My Custom Trip', 'tznew'); ?></span>
            </button>
            
            <div class="form-loading hidden mt-4 text-center">
                <div class="inline-flex items-center space-x-2 text-purple-600">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-purple-600"></div>
                    <span><?php esc_html_e('Creating your custom trip...', 'tznew'); ?></span>
                </div>
            </div>
            
            <div class="form-messages mt-4"></div>
        </div>

        <!-- Contact Information -->
        <div class="form-footer mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-600 mb-2">
                <?php esc_html_e('Questions about customization? Contact our trip planning experts:', 'tznew'); ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6">
                <a href="tel:+977-1-4123456" class="flex items-center space-x-2 text-purple-600 hover:text-purple-800">
                    <i class="fas fa-phone"></i>
                    <span>+977-1-4123456</span>
                </a>
                <a href="mailto:custom@dragonholidays.com" class="flex items-center space-x-2 text-purple-600 hover:text-purple-800">
                    <i class="fas fa-envelope"></i>
                    <span>custom@dragonholidays.com</span>
                </a>
                <a href="https://wa.me/9771234567890" class="flex items-center space-x-2 text-purple-600 hover:text-purple-800">
                    <i class="fab fa-whatsapp"></i>
                    <span><?php esc_html_e('WhatsApp', 'tznew'); ?></span>
                </a>
            </div>
        </div>
    </form>
</div>

<style>
.form-input:focus {
    box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
}

.form-group.error .form-input {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.form-group.success .form-input {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.error-message {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>