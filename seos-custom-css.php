<?php
/**
 * Plugin Name: Seos Custom CSS
 * Plugin URI: https://www.seosthemes.com/custom-css-wp-plugin/
 * Contributors: seosbg
 * Author: seosbg
 * Description: Seos Custom CSS is easy to use. Seos Custom CSS Plugin add custom CSS styling to your WordPress Site.
 * Version: 1.0.1
 * License: GPL2
*/

	//Add Admin Setting
	add_action('admin_menu', 'sccss_menu');
	function sccss_menu() {
    add_menu_page('Seos Custom CSS', 'Seos Custom CSS', 'administrator', 'sccss-settings-group', 'sccss_settings_page', plugins_url('seos-custom-css/images/icon.png')
    );

    add_action('admin_init', 'sccss_register_settings');
}


	// Register Setting
	function sccss_register_settings() {
		register_setting( 'sccss-settings-group', 'sccss_settings' );
	}

	
	// Admin Enqueue Scripts
	
	function sccss_admin_styles() {
	
		wp_register_style( 'sccss_admin', plugin_dir_url(__FILE__) . 'css/admin.css' );
		wp_enqueue_style( 'sccss_admin');
	}
	
	add_action( 'admin_enqueue_scripts', 'sccss_admin_styles' );
	
	
	function sccss_settings_page() { ?>
		
		<div class="wrap">
			<h2><?php _e( 'Seos Custom CSS', 'sccss' ); ?></h2>
			<form name="sccss_form" action="options.php" method="post" >
				<?php settings_fields( 'sccss-settings-group' ); ?>
			<?php do_settings_sections( 'sccss-settings-group' ); ?>
			
				<div id="sccss_wrap">
			<div class="sccss">
				<a target="_blank" href="https://seosthemes.com/">
					<div class="btn s-red">
						 <?php _e('SEOS', 'sccss'); echo ' <img class="ss-logo" src="' . plugins_url( 'images/logo.png' , __FILE__ ) . '" alt="logo" />';  _e(' THEMES', 'sccss'); ?>
					</div>
				</a>
			</div>						
					
					
					<div>
						<textarea style="width: 100%; min-height: 500px;" name="sccss_settings"><?php echo esc_html(get_option( 'sccss_settings' )); ?></textarea>
					</div>
					
						<?php submit_button(); ?>
				
				</div>
			</form>

			
		</div>
		<div class="clear"></div>
	<?php
	}
	
	function sccss_add_style (){ ?>
		<style type="text/css">
			<?php echo esc_html(get_option( 'sccss_settings' )); ?>
		</style>
	<?php }
	add_action('wp_head','sccss_add_style');
	
	function sccss_language_load() {
	  load_plugin_textdomain('sccss_language_load', FALSE, basename(dirname(__FILE__)) . '/languages');
	}
	add_action('init', 'sccss_language_load');