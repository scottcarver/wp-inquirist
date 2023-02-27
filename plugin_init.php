<?php
   /*
   Plugin Name: WP Inquirist
   Plugin URI: https://github.com/scottcarver/wp-inquirist
   description: Require plugins using TGMPA directly from theme.json
   Version: 0.0.1
   */

   /********* Require the standard, unmodified TGM plugin activation plugin ************/
   require_once('TGMPA-TGM-Plugin-Activation-c626d0d/class-tgm-plugin-activation.php');

   // Run TGMPA but rely on theme.json "settings" array
   require_once('load_themejson.php');
?>