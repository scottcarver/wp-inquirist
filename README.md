# WP Inquirist 🕵️

**Allow your theme to require plugins!** This plugin wraps the PHP library [TGMPA](http://tgmpluginactivation.com/) inside a WordPress plugin. View the [WP Inquirist](https://github.com/scottcarver/wp-inquirist) Github Repository for the source code.


### 👉 What does it do?
TGMPA is very useful but setting it up inside a theme, and maintaining the package over time is challenging. Here the standard TGMPA plugin is loaded through the plugin leaving you can *focus on the plugin requirements* instead of the code behind the requirement process.

1. When activated *WP Inquirist* runs a callback for the function `my_theme_register_required_plugins()`<sup>**†**</sup> upon the `tgmpa_register` action occuring.

2. By placing that function `my_theme_register_required_plugins()` in a WP theme you can include a list of required plugins and your WP admin will prompt you to install and activate them.

### 👉 How to get setup

1. To add a similar feature in another theme copy/paste that specially named function from [this file](https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/example.php) in the TGMPA documentation

2. The [WP With Agency](https://github.com/scottcarver/wp-withagency) generator's `theme` command includes [a file](https://github.com/scottcarver/wp-withagency/blob/master/templates/theme/copy/library/function/custom/custom_requiredplugins.php) that is required in the theme's functions.php and it's a good example to copy/paste.

**† - the callback function name** here is normally arbitary when you run the TGMPA plugin. Because this plugin is generalized for multiple use WP Inquirist uses the original name from `example.php` file, `my_theme_register_required_plugins()`


### 🧨 Install with WP CLI
<div style="background:silver;padding:20px;">
If you have the command-line tool [WP CLI](https://wp-cli.org/) you can quickly install this plugin with this command:

`wp plugin install https://github.com/scottcarver/wp-inquirist/archive/refs/heads/main.zip --activate`
</div>


## 🚧 Experimental 🚧
<div style="background:palegoldenrod;padding:10px;outline:dashed 4px black;">
In the future it may be useful to add a feature to WP Withagency:

`wp withagency requiredplugins` 

This would include code to match the standard setup:
1. create custom_requiredplugins.php
2. require it inside of functions.php
</div>