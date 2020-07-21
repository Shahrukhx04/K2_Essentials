<?php
/**
 * Plugin Name: K2 Essentials
 * Plugin URI: https://k2blocks.com/
 * Description: Everything you need before launching the site.
 * Version: 1.0
 * Author: PookiDevs Technologies.
 * Author URI: https://pookidevs.com/
 **/


register_activation_hook(__FILE__, 'add_defaults_fn');
add_action( 'admin_menu', 'add_k2_essentials_sidebar' );
add_action('admin_init', 'sampleoptions_init_fn' );






// Define default option settings
function add_defaults_fn() {
	$tmp = get_option('plugin_options');
    if(($tmp['chkbox1']=='on')||(!is_array($tmp))) {
		$arr = array("dropdown1"=>"Orange", "text_area" => "Space to put a lot of information here!", "text_string" => "Some sample text", "pass_string" => "123456", "chkbox1" => "", "chkbox2" => "on", "option_set1" => "Triangle");
		update_option('plugin_options', $arr);
	}
}

// Add a new top level menu link to the ACP
function add_k2_essentials_sidebar()
{
      add_menu_page(
        'K2 Essentials', // Title of the page
        'K2 Essentials', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'k2-essentials', // The 'slug' - file to display when clicking the link
		'options_page_fn'
    );
	

	
}



function sampleoptions_init_fn (){
	
	register_setting('plugin_options', 'plugin_options', 'plugin_options_validate' );
	add_settings_section('main_section', 'Main Settings', 'section_text_fn', __FILE__);
	add_settings_field('plugin_chk2', 'Enable to redirect login url', 'setting_chk2_fn', __FILE__, 'main_section');
	//add_settings_field('plugin_chk3_login_logo', 'Enable to change login logo', 'setting_checkbox3_login_logo', __FILE__, 'main_section');
	add_settings_field('plugin_chk4_block_editor_gutenbergo', 'Disable for classic gutenberg editor', 'setting_checkbox4_block_editor_gutenberg', __FILE__, 'main_section');
	add_settings_field('plugin_chk5_disable_admin_bar', 'Disable admin bar', 'setting_checkbox5_disable_admin_bar', __FILE__, 'main_section');
	add_settings_field('plugin_chk6_site_under_Maintaince', 'Put Site Under Maintaince', 'setting_checkbox6_site_under_Maintaince', __FILE__, 'main_section');
	add_settings_field('plugin_chk7_hide_update_message', 'Hide Wordpress Update Notice for Clients', 'setting_checkbox7_hide_update_message', __FILE__, 'main_section');
	//add_settings_field('plugin_chk1', 'Restore Defaults Upon Reactivation?', 'setting_chk1_fn', __FILE__, 'main_section');

}


// Section HTML, displayed before the first option
function  section_text_fn() {
	echo '<p>Here, you can enable/disable fields that are needed before deployment</p>';
}


// CHECKBOX - For Default Settings Restoration
function setting_chk1_fn() {
	$options = get_option('plugin_options');
	if($options['chkbox1']) { 
		$checked = ' checked="checked" ';
	
	}
	echo "<input ".$checked." id='plugin_chk1' name='plugin_options[chkbox1]' type='checkbox' />";
}

// CHECKBOX - For Login Redirect
function setting_chk2_fn() {
	$options = get_option('plugin_options');
	if($options['chkbox2']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk2' name='plugin_options[chkbox2]' type='checkbox' />
	<p>Page Slug </p>
	<input id='plugin_text_string' name='plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />	</div>
	";
}


// CHECKBOX - For Change Login Logo
function setting_checkbox3_login_logo() {
	$options = get_option('plugin_options');
	if($options['chkbox3_login_logo']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk3_login_logo' name='plugin_options[chkbox3_login_logo]' type='checkbox' />
	";
}

// CHECKBOX - For Block Editor Gutenberg
function setting_checkbox4_block_editor_gutenberg() {
	$options = get_option('plugin_options');
	if($options['chkbox4_block_editor_gutenberg']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk4_block_editor_gutenbergo' name='plugin_options[chkbox4_block_editor_gutenberg]' type='checkbox' />
	";
}

// CHECKBOX - For disable of admin bar
function setting_checkbox5_disable_admin_bar() {
	$options = get_option('plugin_options');
	if($options['chkbox5_disable_admin_bar']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk5_disable_admin_bar' name='plugin_options[chkbox5_disable_admin_bar]' type='checkbox' />
	";
}

// CHECKBOX - For putting site under maintaince
function setting_checkbox6_site_under_Maintaince() {
	$options = get_option('plugin_options');
	if($options['chkbox6_site_under_Maintaince']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk6_site_under_Maintaince' name='plugin_options[chkbox6_site_under_Maintaince]' type='checkbox' />
	";
}


// CHECKBOX - Hide Update Messages
function setting_checkbox7_hide_update_message() {
	$options = get_option('plugin_options');
	if($options['chkbox7_hide_update_message']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk7_hide_update_message' name='plugin_options[chkbox7_hide_update_message]' type='checkbox' />
	";
}


// Sanitize and validate input. Accepts an array, return a sanitized array.
function wpet_validate_options($input) {
	// Sanitize textarea input (strip html tags, and escape characters)
	//$input['textarea_one'] = wp_filter_nohtml_kses($input['textarea_one']);
	//$input['textarea_two'] = wp_filter_nohtml_kses($input['textarea_two']);
	//$input['textarea_three'] = wp_filter_nohtml_kses($input['textarea_three']);
	return $input;
}


// Display the admin options page
function options_page_fn() {
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Welcome to K2 Essentials</h2>
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
<?php
}


// Validate user data for some/all of your input fields
function plugin_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	$input['text_string'] =  wp_filter_nohtml_kses($input['text_string']);	
	return $input; // return validated input
}


function prevent_wp_login() {
	
	
	$options = get_option('plugin_options');
	if($options['chkbox2']=='on') { 
		   // WP tracks the current page - global the variable to access it
			global $pagenow;
			// Check if a $_GET['action'] is set, and if so, load it into $action variable
			$action = (isset($_GET['action'])) ? $_GET['action'] : '';
			// Check if we're on the login page, and ensure the action is not 'logout'
			if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
				// Load the home page url
				$page = $options['text_string'];
				// Redirect to the home page
				wp_redirect($page);
				// Stop execution to prevent the page loading for any reason
				exit();
			}
	}
}
add_filter('login_redirect', 'prevent_wp_login', 999999999, 3);

function modify_logo() {
	$options = get_option('plugin_options');
	if($options['chkbox3_login_logo']=='on') { 
		$logo_style = '<style type="text/css">';
		$logo_style .= 'h1 a {background-image: url(https://i2.wp.com/pookidevs.com/wp-content/uploads/2020/05/Pookidfevs-logo-transparent-e1588972506839.png?fit=907%2C835&ssl=1) !important;}';
		$logo_style .= '</style>';
		echo $logo_style;
	}
}
add_action('login_head', 'modify_logo');

function wp_maintenance_mode(){
	if(!current_user_can('edit_themes') || !is_user_logged_in()){
		wp_die('Maintenance, please come back soon.', 'Maintenance - please come back soon.', array('response' => '503'));
	}
}

function perform_checked_snippets(){
	$options = get_option('plugin_options');
	
	
	
	if($options['chkbox4_block_editor_gutenberg']=='on') { 
		add_filter('use_block_editor_for_post', '__return_false', 10);
	}
	
	if($options['chkbox5_disable_admin_bar']=='on') { 
		add_filter( 'show_admin_bar', '__return_false' );
	}
		
		
	if($options['chkbox6_site_under_Maintaince']=='on') { 
		add_action('get_header', 'wp_maintenance_mode');
	}
	
	if($options['chkbox7_hide_update_message']=='on') { 
		add_action('admin_menu','wphidenag');	
	}
}


add_action('init', 'perform_checked_snippets');


function wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}


?>


