# WP Inquirist 🕵️

**Allow your theme to ask for plugins!** This plugin includes the  [TGMPA v2.6.1](http://tgmpluginactivation.com/) library so you can get straight to the task of requiring plugins within your theme (or plugin).

<!-- ![Tux, the Linux mascot](https://place-hold.it/1280x720) -->

### 👉 What does it do?
TGMPA is very useful for requiring plugins but setting it up inside a theme and maintaining the package is potentially confusing and challenging. Here the standard TGMPA code is loaded through a plugin leaving theme authors to *focus on the plugin requirements* instead of the code behind the requirement process.

1. When activated *WP Inquirist* loads the TGMPA library in the background, but it is not used.

2. Inside your theme call the `tgmpa_register` action with a valid callback function. See `example.php` for an example. Place this inside functions.php or even better, a seperate file for safekeeping.

<!-- **FOOTNOTES:**
**† - the callback function name** in the `example.php` file is called `wpinquirist_registerrequiredplugins` but is arbitrary - the important thing is that the function callback matches the name used in the tgmpa_register action. -->


### 👉 How to add Required Plugins to a Theme

1. Copy/paste the contents of the [example.php file](https://github.com/scottcarver/wp-inquirist/blob/main/example.php) into your theme. Note that the callback function name is arbitrary, it simply needs to match the action.

2. The [WP With Agency](https://github.com/scottcarver/wp-withagency) generator's `theme` command includes [a file](https://github.com/scottcarver/wp-withagency/blob/master/templates/theme/copy/library/function/custom/custom_requiredplugins.php) that is required in the theme's functions.php and it's the same as example.php.

---

###  🔒 Private Plugins

Even though not all plugins are publicliy visible you can still 1) Require them by name/slug 2) Link to the resource.

This may require you to take *further steps* depending on the type of plugin to secure it. Once it's installed the need will have been met. If, in the future TGMPA offers the ability to use private repos, that will be added to this project.


---

### 🧨 Install with WP CLI
If you have the command-line tool [WP CLI](https://wp-cli.org/) you can quickly install this plugin with this command:

`wp plugin install https://github.com/scottcarver/wp-inquirist/archive/refs/heads/main.zip --activate`

---

## 🚧 Experimental
In the future it may be useful to add a feature to WP Withagency to retrofit old themes. Themes created using the `wp withagency theme` command already include a set of requirements, but most users will not be starting from that point and must first copy/paste some boilerplate. The location may vary slightly versus the default (it's in `/library/function/custom/custom_requiredplugins.php` inside a generated theme).

**Example:**

`wp withagency requiredplugins` 

This would include code to match the standard setup:
1. create custom_requiredplugins.php
2. require it inside of functions.php
