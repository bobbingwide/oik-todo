# oik-todo 
![banner](assets/oik-todo-banner-772x250.jpg)
* Contributors: bobbingwide
* Donate link: https://oik-plugins.com/oik/oik-donate/
* Tags: CPT, TODO, oik, custom fields
* Requires at least: 3.8
* Tested up to: 6.3.1
* Stable tag: 0.3.0
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: oik-todo
* Domain Path: /languages/

## Description 
TODO custom post type ( oik_todo ) used to create a list of TODO tasks that you can work through when you've nothing else TO DO.

Fat chance... the list just get's longer and longer.

Use in conjunction with [bw_related] to show the list of things to do in the future and the list of things to do in the past.


## Installation 
1. Upload the contents of the oik-todo plugin to the `/wp-content/plugins/oik-todo' directory
1. Activate the oik-todo plugin through the 'Plugins' menu in WordPress

## Frequently Asked Questions 
# How do I display the TODO's? 

* Use an oik base shortcode such as [bw_table].
* Since the TODO's are hierarchical you can also use [bw_tree]
* Depending on how "nicely" you created your TODO content you could even used [bw_pages with the format= parameter]

# Is there an oik-todo template? 
No, but you could make one if you thought it was necessary?


## Screenshots 
1. oik-todo in action

## Upgrade Notice 
# 0.3.0 
Now works with PHP 8.2.

# 0.2.1 
Now registers the plugin server for updates.

# 0.2 
Required for examples of [bw_related] using date fields.

# 0.1 
Depends on oik and oik-fields

## Changelog 
# 0.3.0 
* Changed: Updated for PHP 8.2 support #1
* Fixed: Avoids Fatal error in WordPress dashboard All items #1
* Tested: With WordPress 6.3.1
* Tested: With PHP 8.2

# 0.2.1 
* Added: Registers the plugin for updates from oik servers.

# 0.2 
* Added: made public so that it could be used to demonstrate oik-dates functionality
* Note: oik-todo is not dependent upon oik-dates but you can use oik-dates functionality against the 'date' type fields with the [bw_related] shortcode.

# 0.1 
* Added: New plugin to demonstrate oik and oik-fields whilst keeping a list of things TODO


## Further reading 
If you want to read more about the oik plugins then please visit the
[oik plugin](https://www.oik-plugins.com/oik)
**"the oik plugin - for often included key-information"**

