<?php
/**
 * Plugin Name: K2 Essentials
 * Plugin URI: https://k2blocks.com/
 * Description: Everything you need before launching the site.
 * Version: 1.0
 * Author: PookiDevs Technologies.
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
	add_settings_section('main_section', 'Main Settings', 'k2_essentials_section_text_fn', __FILE__);
	add_settings_field('plugin_chk2', 'Enable to redirect login url', 'k2_essentials_setting_chk2_fn', __FILE__, 'main_section');
	add_settings_field('plugin_chk4_block_editor_gutenbergo', 'Disable for classic gutenberg editor', 'k2_essentials_setting_checkbox4_block_editor_gutenberg', __FILE__, 'main_section');
	add_settings_field('plugin_chk5_disable_admin_bar', 'Disable admin bar', 'k2_essentials_setting_checkbox5_disable_admin_bar', __FILE__, 'main_section');
	add_settings_field('plugin_chk6_site_under_Maintaince', 'Put Site Under Maintaince', 'k2_essentials_setting_checkbox6_site_under_Maintaince', __FILE__, 'main_section');
	add_settings_field('plugin_chk7_hide_update_message', 'Hide Wordpress Update Notice for Clients', 'k2_essentials_setting_checkbox7_hide_update_message', __FILE__, 'main_section');

}


// Section HTML, displayed before the first option
function  k2_essentials_section_text_fn() {
	echo '<p>Here, you can enable/disable fields that are needed before deployment</p>';
}


// CHECKBOX - For Login Redirect
function k2_essentials_setting_chk2_fn() {
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


// CHECKBOX - For Block Editor Gutenberg
function k2_essentials_setting_checkbox4_block_editor_gutenberg() {
	$options = get_option('plugin_options');
	if($options['chkbox4_block_editor_gutenberg']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk4_block_editor_gutenbergo' name='plugin_options[chkbox4_block_editor_gutenberg]' type='checkbox' />
	";
}

// CHECKBOX - For disable of admin bar
function k2_essentials_setting_checkbox5_disable_admin_bar() {
	$options = get_option('plugin_options');
	if($options['chkbox5_disable_admin_bar']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk5_disable_admin_bar' name='plugin_options[chkbox5_disable_admin_bar]' type='checkbox' />
	";
}

// CHECKBOX - For putting site under maintaince
function k2_essentials_setting_checkbox6_site_under_Maintaince() {
	$options = get_option('plugin_options');
	if($options['chkbox6_site_under_Maintaince']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk6_site_under_Maintaince' name='plugin_options[chkbox6_site_under_Maintaince]' type='checkbox' />
	";
}


// CHECKBOX - Hide Update Messages
function k2_essentials_setting_checkbox7_hide_update_message() {
	$options = get_option('plugin_options');
	if($options['chkbox7_hide_update_message']=='on') { 
		$checked = ' checked="checked" '; 
	}
	echo "<div>
	<input ".$checked." id='plugin_chk7_hide_update_message' name='plugin_options[chkbox7_hide_update_message]' type='checkbox' />
	";
}


// Display the admin options page
function k2_essentials_options_page_fn() {
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
function k2_essentials_plugin_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	return $input; // return validated input
}


function k2_essentials_prevent_wp_login() {
	
	
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
add_filter('login_redirect', 'k2_essentials_prevent_wp_login', 999999999, 3);

function k2_essentials_wp_maintenance_mode(){
	if(!current_user_can('edit_themes') || !is_user_logged_in()){
		wp_die('Maintenance, please come back soon.', 'Maintenance - please come back soon.', array('response' => '503'));
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
}


add_action('init', 'k2_essentials_perform_checked_snippets');


function k2_essentials_wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}


?>


