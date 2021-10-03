# WP Inquirist 🕵️

**Allow your theme to ask for plugins!** This plugin wraps the PHP library [TGMPA](http://tgmpluginactivation.com/) inside a WordPress plugin. View the [WP Inquirist](https://github.com/scottcarver/wp-inquirist) Github repository for the source code.


### 👉 What does it do?
TGMPA is very useful but setting it up inside a theme and maintaining the package over time can be challenging. Here the standard TGMPA code is loaded through a WP plugin leaving you to *focus on the plugin requirements* instead of the code behind the requirement process.

1. When activated *WP Inquirist* runs a callback for the function `my_theme_register_required_plugins()`<sup>**†**</sup> upon the `tgmpa_register` action occuring (any time the page loads inside the admin area).

2. By placing a function with the *unique name* `my_theme_register_required_plugins()` inside **YOUR WP theme** you can include a list of required plugins and your WP admin will prompt you to install and activate them.

**FOOTNOTES:**
**† - the callback function name** here is arbitary when you run the TGMPA plugin, however, to simplify things *this plugin is generalized* for multiple uses the original name from the reference file `example.php` file (`my_theme_register_required_plugins()`) is retained!


### 👉 How to get setup

1. To add a similar feature in another theme copy/paste that specially named function from [this file](https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/example.php) in the TGMPA documentation

2. The [WP With Agency](https://github.com/scottcarver/wp-withagency) generator's `theme` command includes [a file](https://github.com/scottcarver/wp-withagency/blob/master/templates/theme/copy/library/function/custom/custom_requiredplugins.php) that is required in the theme's functions.php and it's a good example to copy/paste.

---

###  👉 Private Plugins

Even though not all plugins are publicliy visible you can still 1) Require them by name/slug 2) Link to the resource.

This may require you to take *further steps* depending on the type of plugin to secure it. Once it's installed the need will have been met. If, in the future TGMPA offers the ability to use private repos, that will be added to this project.


---

### 🧨 Install with WP CLI
If you have the command-line tool [WP CLI](https://wp-cli.org/) you can quickly install this plugin with this command:

`wp plugin install https://github.com/scottcarver/wp-inquirist/archive/refs/heads/main.zip --activate`

---

## 🚧 Experimental 🚧
In the future it may be useful to add a feature to WP Withagency:

`wp withagency requiredplugins` 

This would include code to match the standard setup:
1. create custom_requiredplugins.php
2. require it inside of functions.php