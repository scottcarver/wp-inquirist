<?php

/* Check for TGMPA plugin */
if(class_exists('TGM_Plugin_Activation')){
	// Run TGMPA requirements using theme.json (or theme-plugins.json)
	add_action( 'tgmpa_register', 'wpinquirist_registerrequiredplugins' );
} 

/*
else {
	// Show and Admin Warning
	add_action( 'admin_notices', 'wpinquirist_registerrequiredplugins_warning' );
}


// Add a fallback admin warning 
function wpinquirist_registerrequiredplugins_warning() {
	// Request Theme JSON Data
	$themejson_data = request_themejsondata();
	// $theme_preferred = $themejson_data->file === 'theme.json';
	$remoteurl = 'https://github.com/scottcarver/wp-inquirist';
	$class = 'notice notice-warning is-dismissible';
	$message = __( '<strong>WP Inquirist:</strong> The current theme (<em>'.wp_get_theme().'</em>) would like to install some plugins (as defined in <em>'.$themejson_data->file.'</em>). <a href="' . $remoteurl . '">Read More</a>', 'wp-inquirist' );
	echo '<div class="'.$class.'"><p>'.$message.'</p></div>';
	// printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
*/


/* This is a callback used in the TGMPA plugin. If you have the wp-inquirist plugin installed (which boots TGMPA) your WP install will prompt you for plugins when your theme is activated! */
function wpinquirist_registerrequiredplugins() {

	// Request Theme JSON Data
	$themejson_data = request_themejsondata();
	$themejson_plugins = $themejson_data["plugins"];

	// Only instantiate if they are listed
	if(is_array($themejson_plugins)){
		// var_dump($themejson_data);

		// Array of configuration settings.
		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => 'REQUIRED PLUGINS',      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		// Run TGMPA from theme.json data
		tgmpa( $themejson_plugins, $config );
	}
}

// Selectively pluck data from theme.json
function request_themejsondata(){
	// Define paths to theme-plugins.json and theme.json
	$relativePath = ".." . str_replace(get_site_url(),'',get_template_directory_uri());
	$filenamePlugins = $relativePath.'/theme-plugins.json';
	$filenameTheme = $relativePath.'/theme.json';
	// $themeFile = '';
	
	// Default to theme-plugins.json
	if(file_exists($filenamePlugins) == true) {
		$themejson = file_get_contents($filenamePlugins);
		$themejson_data = json_decode($themejson,true);
		// $themeFile = 'theme-plugins.json';
	// Alternatively, theme.json can be used
	} elseif(file_exists($filenameTheme) == true) {
		$themejson = file_get_contents($filenameTheme);
		$themejson_data = json_decode($themejson,true);
		// $themeFile = 'theme.json';
	}

	/*
	return (object)[
		"file" => $themeFile,
		"data" => $themejson_data
	];
	*/
	return $themejson_data;
}