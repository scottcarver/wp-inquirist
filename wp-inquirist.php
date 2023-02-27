<?php
   /*
   Plugin Name: WP Inquirist
   Plugin URI: https://github.com/scottcarver/wp-inquirist
   description: Require plugins using TGMPA directly from theme.json
   Version: 0.0.2
   Author: Scott Carver
   Author URI: https://scottcarver.info
   */

   /********* Require TGM plugin activation tool ************/
   require_once('lib/tgm-plugin-activation/class-tgm-plugin-activation.php');


   /********* Check for TGMPA and Kickoff Activity ************/
   if(class_exists('TGM_Plugin_Activation')){
      add_action( 'tgmpa_register', 'wpinquirist_registerrequiredplugins' );
   } 

   /********* Run TGMPA using theme.json "plugins" data ************/
   function wpinquirist_registerrequiredplugins() {

      // Check url to see if it's the plugins page
      $site_link = explode('/', $_SERVER['PHP_SELF']);
      $site_showingplugins = $site_link[sizeof($site_link) - 1] === 'plugins.php';

      // Request Theme JSON Data
      $themejson_data = request_themejsondata();
      $themejson_plugins = array_key_exists("plugins",$themejson_data) ? $themejson_data["plugins"] : null;

      // Only instantiate on the plugins page and when plugins are listed
      if($site_showingplugins && is_array($themejson_plugins)){
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

   // Selectively pluck data from theme-plugins.json or theme.php
   function request_themejsondata(){
      // Define paths to theme-plugins.json and theme.json
      $relativePath = ".." . str_replace(get_site_url(),'',get_template_directory_uri());
      $filenamePlugins = $relativePath.'/theme-plugins.json';
      $filenameTheme = $relativePath.'/theme.json';
      // Default to theme-plugins.json
      if(file_exists($filenamePlugins) == true) {
         $themejson = file_get_contents($filenamePlugins);
      // Alternatively, theme.json can be used
      } elseif(file_exists($filenameTheme) == true) {
         $themejson = file_get_contents($filenameTheme);
      }

      if($themejson){
         return json_decode($themejson,true);
      }
   }

?>