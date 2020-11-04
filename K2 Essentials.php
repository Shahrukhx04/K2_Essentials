<?php
/**
 * Plugin Name: K2 Essentials
 * Plugin URI: https://pookidevs.com/
 * Description: Everything you need before launching the site.
 * Version: 1.1
 * Author: PookiDevs.
 * Author URI: https://pookidevs.com/
 **/


add_action( 'admin_menu', 'add_k2_essentials_sidebar' );
add_action('admin_init', 'k2_essentials_init' );







// Add a new top level menu link to the ACP
function add_k2_essentials_sidebar()
{
      add_menu_page(
        'K2 Essentials', // Title of the page
        'K2 Essentials', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'k2-essentials', // The 'slug' - file to display when clicking the link
		'k2_essentials_options_page_fn'
    );
	

	
}



function k2_essentials_init (){
	
	register_setting('plugin_options', 'plugin_options', 'k2_essentials_plugin_options_validate' );
	add_settings_section('main_section', '<div class="k2_essentials_Setting_Tab_Title">General Settings</div>', 'k2_essentials_section_text_fn', __FILE__);
	add_settings_field('plugin_chk2', '<div class="k2_essentials_setting_label">Enable to redirect login url</div>', 'k2_essentials_setting_chk2_fn', __FILE__, 'main_section');
	add_settings_field('plugin_chk4_block_editor_gutenbergo', '<div class="k2_essentials_setting_label">Disable for classic gutenberg editor</div>', 'k2_essentials_setting_checkbox4_block_editor_gutenberg', __FILE__, 'main_section');
	add_settings_field('plugin_chk5_disable_admin_bar', '<div class="k2_essentials_setting_label">Disable admin bar</div>', 'k2_essentials_setting_checkbox5_disable_admin_bar', __FILE__, 'main_section');
	add_settings_field('plugin_chk6_site_under_Maintaince', '<div class="k2_essentials_setting_label">Put Site Under Maintaince</div>', 'k2_essentials_setting_checkbox6_site_under_Maintaince', __FILE__, 'main_section');
	add_settings_field('plugin_chk7_hide_update_message', '<div class="k2_essentials_setting_label">Hide Wordpress Update Notice for Clients</div>', 'k2_essentials_setting_checkbox7_hide_update_message', __FILE__, 'main_section');
	
	add_settings_field('k2_essentials_Disable_Image_Compressor', '<div class="k2_essentials_setting_label">Disable Wordpress Default Image Compressor</div>','k2_essentials_setting_Disable_Image_Compression', __FILE__, 'main_section');
	
	
	add_settings_section('Woo_Section', '<div class="k2_essentials_Setting_Tab_Title">Woocommerce Settings</div>', 'k2_essentials_woo_commerce_settings', __FILE__);
	
	add_settings_field('k2_essentials_Bypass_add_to_cart', '<div class="k2_essentials_setting_label">Bypass Add to Cart</div>','k2_essentials_Setting_Bypass_add_to_cart', __FILE__, 'Woo_Section');
	
	add_settings_field('k2_essentials_Product_Already_In_Cart', '<div class="k2_essentials_setting_label">Display “product already in cart” instead of “add to cart” button</div>','k2_essentials_Setting_Product_Already_In_Cart', __FILE__, 'Woo_Section');
	
	add_settings_field('k2_essentials_Minumin_Order_Amount', '<div class="k2_essentials_setting_label">Set minimum order amount</div>','k2_essentials_Setting_Minumin_Order_Amount', __FILE__, 'Woo_Section');

	add_settings_field('k2_essentials_Keep_Last_Item_In_Cart', '<div class="k2_essentials_setting_label">Keep Last Item in Cart</div>','k2_essentials_Keep__Setting_Last_Item_In_Cart', __FILE__, 'Woo_Section');

		add_settings_field('k2_essentials_Remove_Password_Strenght_Check', '<div class="k2_essentials_setting_label">Remove Woocommerce Password Strenght Check</div>','k2_essentials_Remove_Setting_Password_Strenght_Check', __FILE__, 'Woo_Section');

	add_settings_field('k2_essentials_Replace_out_of_stock', '<div class="k2_essentials_setting_label">Replace Out of Stock Text</div>','k2_essentials_Replace_out_Setting_of_stock', __FILE__, 'Woo_Section');
}
add_action( 'admin_enqueue_scripts', 'load_admin_styles' );

function load_admin_styles() {
	wp_enqueue_style( 'admin_css_foo', plugin_dir_url(__FILE__) . '/styles.css', false, '1.0.0' );
}  

// Section HTML, displayed before the first option
function  k2_essentials_section_text_fn() {
	echo '<div>
		<p>Here, you can enable/disable fields that are needed before deployment</p>
	
	</div>';
}

function k2_essentials_woo_commerce_settings(){
	echo '<div>
			<p>Here, you can enable/disable fields that are needed before deployment</p>
		</div>';
	
}


// CHECKBOX - For Login Redirect
function k2_essentials_setting_chk2_fn() {
	$options = get_option('plugin_options');
	if($options['chkbox2']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
	<div class='k2_essentials_redirect_url_div2'>
		<label class='k2_essenetials_switch'>
			<input ".$checked." id='plugin_chk2' name='plugin_options[chkbox2]' type='checkbox' />
			<span class='k2_essenetials_slider k2_essenetials_round'></span>
		</label>
	</div>
	
	<div class='k2_essentials_redirect_url_div2'>
		<p>Page Slug</p> 
	</div>
	
	<div class='k2_essentials_redirect_url_div3' >
		<input id='plugin_text_string' name='plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />	
	</div>
	
	</div>
				
	";
}


// CHECKBOX - For Block Editor Gutenberg
function k2_essentials_setting_checkbox4_block_editor_gutenberg() {
	$options = get_option('plugin_options');
	if($options['chkbox4_block_editor_gutenberg']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='plugin_chk4_block_editor_gutenbergo' name='plugin_options[chkbox4_block_editor_gutenberg]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		  </div>
	";
}


// CHECKBOX - For disable of Wordpress Default Image Compressor
function k2_essentials_setting_Disable_Image_Compression() {
	$options = get_option('plugin_options');
	if($options['k2_essentials_Disable_Image_Compressor_CheckBox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2_essentials_Disable_Image_Compressor' name='plugin_options[k2_essentials_Disable_Image_Compressor_CheckBox]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
		</div>
	";
}

// CHECKBOX - For disable of admin bar
function k2_essentials_setting_checkbox5_disable_admin_bar() {
	$options = get_option('plugin_options');
	if($options['chkbox5_disable_admin_bar']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='plugin_chk5_disable_admin_bar' name='plugin_options[chkbox5_disable_admin_bar]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
		</div>
	";
}

// CHECKBOX - For putting site under maintaince
function k2_essentials_setting_checkbox6_site_under_Maintaince() {
	$options = get_option('plugin_options');
	if($options['chkbox6_site_under_Maintaince']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='plugin_chk6_site_under_Maintaince' name='plugin_options[chkbox6_site_under_Maintaince]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}


// CHECKBOX - Hide Update Messages
function k2_essentials_setting_checkbox7_hide_update_message() {
	$options = get_option('plugin_options');
	if($options['chkbox7_hide_update_message']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='plugin_chk7_hide_update_message' name='plugin_options[chkbox7_hide_update_message]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}


// WooCommerce Setting Options Functions
// 
// 
// 
// Bypass Add to cart

function k2_essentials_Setting_Bypass_add_to_cart() {
	$options = get_option('plugin_options');
	
	if($options['k2_essentials_Bypass_add_to_cart_Checkbox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2_essentials_Bypass_add_to_cart' name='plugin_options[k2_essentials_Bypass_add_to_cart_Checkbox]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}

// Product Already in Cart


function k2_essentials_Setting_Product_Already_In_Cart() {
	$options = get_option('plugin_options');
	
	if($options['k2_essentials_Setting_Product_Already_In_Cart_Checkbox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2_essentials_Product_Already_In_Cart' name='plugin_options[k2_essentials_Setting_Product_Already_In_Cart_Checkbox]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}



// Set Minimum Order Amount
// 
function k2_essentials_Setting_Minumin_Order_Amount() {
	$options = get_option('plugin_options');
	
	if($options['k2_essentials_Minumin_Order_Amount_Checkbox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<div class='k2_essentials_redirect_url_div2'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2_essentials_Minumin_Order_Amount' name='plugin_options[k2_essentials_Minumin_Order_Amount_Checkbox]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
			</div>

			<div class='k2_essentials_redirect_url_div2'>
				<p>Order Amount</p> 
			</div>

			<div class='k2_essentials_redirect_url_div3' >
				<input id='k2_essentials_Minimum_Order_Amount_Input' name='plugin_options[k2_essentials_Minimum_Order_Amount_Input_Option]' size='40' type='number' value='{$options['k2_essentials_Minimum_Order_Amount_Input_Option']}' />	
			</div>

			</div>";
}

// Keep Last item in cart


function k2_essentials_Keep__Setting_Last_Item_In_Cart() {
	$options = get_option('plugin_options');
	
	if($options['k2_essentials_Keep__Setting_Last_Item_In_Cart_CheckBox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2_essentials_Keep_Last_Item_In_Cart' name='plugin_options[k2_essentials_Keep__Setting_Last_Item_In_Cart_CheckBox]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}


	
// Remove Password Strenght Check

function k2_essentials_Remove_Setting_Password_Strenght_Check() {
	$options = get_option('plugin_options');
	
	if($options['k2_essentials_Remove_Password_Strenght_Check_CheckBox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<label class='k2_essenetials_switch'>
				<input ".$checked." id='k2_essentials_Remove_Password_Strenght_Check' name='plugin_options[k2_essentials_Remove_Password_Strenght_Check_CheckBox]' type='checkbox' />
				<span class='k2_essenetials_slider k2_essenetials_round'></span>
			</label>
		</div>
	";
}	

// Replace Out of Stock Text 
	
function k2_essentials_Replace_out_Setting_of_stock() {
	$options = get_option('plugin_options');
	
	if($options['k2_essentials_Replace_out_Setting_of_stock_CheckBox']=='on') { 
		$checked = ' checked="checked" '; 
	}
	
	echo "<div class='k2_essentials_setting_toggle'>
			<div class='k2_essentials_redirect_url_div2'>
				<label class='k2_essenetials_switch'>
					<input ".$checked." id='k2_essentials_Replace_out_of_stock' name='plugin_options[k2_essentials_Replace_out_Setting_of_stock_CheckBox]' type='checkbox' />
					<span class='k2_essenetials_slider k2_essenetials_round'></span>
				</label>
			</div>

			<div class='k2_essentials_redirect_url_div2'>
				<p>New Text</p> 
			</div>

			<div class='k2_essentials_redirect_url_div3' >
				<input id='k2_essentials_Replace_out_Setting_of_stock_Input' name='plugin_options[k2_essentials_Replace_out_Setting_of_stock_CheckBox_option]' size='40' type='text' value='{$options['k2_essentials_Replace_out_Setting_of_stock_CheckBox_option']}' />	
			</div>

			</div>";
}
// Display the admin options page
function k2_essentials_options_page_fn() {
?>
  <div class="k2_essentials_parent_Class">
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<div class="K2_essentials_welcome_message_parent">
			<h2 class="K2_essentials_welcome_message">Welcome to K2 Essentials</h2>
		</div>
		<div class="k2_essentials_divider_parent">
			<hr class="k2_essentials_divider">
		</div>
		<form action="options.php" method="post">
					<?php
						if ( function_exists('wp_nonce_field') ) 
							wp_nonce_field('plugin-name-action_' . "yep"); 
						?>
		<?php settings_fields('plugin_options'); ?>
		<?php do_settings_sections(__FILE__); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
		</form>
	  </div>
  </div>
<?php
}


// Validate user data for some/all of your input fields
function k2_essentials_plugin_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	return $input; // return validated input
}


function k2_essentials_prevent_wp_login() {

		   // WP tracks the current page - global the variable to access it
			global $pagenow;
			// Check if a $_GET['action'] is set, and if so, load it into $action variable
			$action = (isset($_GET['action'])) ? $_GET['action'] : '';
			// Check if we're on the login page, and ensure the action is not 'logout'
			if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
				// Load the home page url
				$page = 'my-account';
				// Redirect to the home page
				wp_redirect($page);
				// Stop execution to prevent the page loading for any reason
				exit();
			}
}

function k2_essentials_wp_maintenance_mode(){
	if(!current_user_can('edit_themes') || !is_user_logged_in()){
		wp_die('This website is undergoing Maintenance, please come back soon.', 'This website is undergoing Maintenance - please come back soon.', array('response' => '503'));
	}
}

function k2_essentials_perform_checked_snippets(){
	$options = get_option('plugin_options');
	
	
	
	if($options['chkbox4_block_editor_gutenberg']=='on') { 
		add_filter('use_block_editor_for_post', '__return_false', 10);
	}
	
	if($options['chkbox5_disable_admin_bar']=='on') { 
		add_filter( 'show_admin_bar', '__return_false' );
	}
		
		
	if($options['chkbox6_site_under_Maintaince']=='on') { 
		add_action('get_header', 'k2_essentials_wp_maintenance_mode');
	}
	
	if($options['chkbox7_hide_update_message']=='on') { 
		add_action('admin_menu','wphidenag');	
	}
	
	if($options['chkbox2']=='on') { 
		add_filter('login_redirect', 'k2_essentials_prevent_wp_login', 999999999, 3);
	}
	
	if ($options['k2_essentials_Disable_Image_Compressor_CheckBox']=='on'){
		add_filter( 'big_image_size_threshold', '__return_false' );
	}
	
	// WooCommerce if Options
	// 
	
	if ($options['k2_essentials_Bypass_add_to_cart_Checkbox']=='on'){
		add_filter('woocommerce_add_to_cart_redirect', 'k2_essentials_Bypass_Cart_Function');
	}

	if ($options['k2_essentials_Setting_Product_Already_In_Cart_Checkbox']=='on'){
		add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
		add_filter( 'add_to_cart_text', 'woo_archive_custom_cart_button_text' );

	}
	if ($options['k2_essentials_Minumin_Order_Amount_Checkbox']=='on'){
		add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
		add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );	
	}
	
	if($options['k2_essentials_Keep__Setting_Last_Item_In_Cart_CheckBox'] == 'on'){
		add_filter( 'woocommerce_add_to_cart_validation', 'remove_cart_item_before_add_to_cart', 20, 3 );
	}
	
	if($options['k2_essentials_Remove_Password_Strenght_Check_CheckBox']=='on'){
		add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );
	}
	
	if ($options['k2_essentials_Replace_out_Setting_of_stock_CheckBox']=='on'){
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);

	}
}


function wcs_custom_get_availability( $availability, $_product ) {
  
	$options = get_option('plugin_options');

    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __($options['k2_essentials_Replace_out_Setting_of_stock_CheckBox_option'], 'woocommerce');
    }
    return $availability;
}
function wc_ninja_remove_password_strength()
{ 
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) 
		{
			wp_dequeue_script( 'wc-password-strength-meter' ); 
		} 

}


function remove_cart_item_before_add_to_cart( $passed, $product_id, $quantity ) {
    if( ! WC()->cart->is_empty() )
        WC()->cart->empty_cart();
    return $passed;
}


function wc_minimum_order_amount() {
    // Set this variable to specify a minimum order value
    // 
    $options = get_option('plugin_options');

    $minimum = $options['k2_essentials_Minimum_Order_Amount_Input_Option'];

    if ( WC()->cart->total < $minimum ) {

        if( is_cart() ) {

            wc_print_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order. ' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );

        } else {

            wc_add_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order.' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );

        }
    }
}

function k2_essentials_Bypass_Cart_Function() {
 global $woocommerce;
 $checkout_url = wc_get_checkout_url();
 return $checkout_url;
}

function woo_custom_cart_button_text() {

	global $woocommerce;
	
	foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		$_product = $values['data'];
	
		if( get_the_ID() == $_product->id ) {
			return __('Already in cart - Add Again?', 'woocommerce');
		}
	}
	
	return __('Add to cart', 'woocommerce');
}


function woo_archive_custom_cart_button_text() {

	global $woocommerce;
	
	foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		$_product = $values['data'];
	
		if( get_the_ID() == $_product->id ) {
			return __('Already in cart', 'woocommerce');
		}
	}
	
	return __('Add to cart', 'woocommerce');
}

add_action('init', 'k2_essentials_perform_checked_snippets');

function k2_essentials_wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}




?>


