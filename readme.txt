=== WP Multibox ===
Contributors: 3dolab
Homepage: http://www.3dolab.net/en/247/wordpress-multibox-plugin
Tags: wordpress, multibox, plugin, image, images, popup, lightbox, greybox, mootools, modal, javascript, effect, phatfusion
Requires at least: 2.5.1
Tested up to: 3.1.3
Stable tag: 1.6

This plugin adds the Multibox lightbox script from phatfusion to WordPress in unobtrusive way.
Now natively supporting post inclusion through AJAX!

== Description ==

The Multibox script by [phatfusion](http://www.phatfusion.net/projects.html), further improved by [Liam Smart](http://www.liamsmart.co.uk/Downloads/multiBox/) is probably the best lightbox option within the MooTools framework.
It handles images, flash video and swf, ajax and remote html, realmedia, windows media, pdf and mp3 playback, with automatic slideshows.
Colors, borders and custom icon folder could be set directly on the settings page.

Since the [first porting](http://wordpress.org/extend/plugins/wordpress-multibox-plugin) of the script as a WordPress plugin, by [Manfred Rutschmann](http://www.rutschmann.biz), is no longer updated, this release is purposed to load the script with wp_enqueue_script function in order to avoid conflicts.
In addition, inline elements, Ajax requests and the latest [MooTools framework version 1.3](http://mootools.net) are supported! 

= Plugin Homepage and Demo =

http://www.3dolab.net/en/wordpress-multibox-plugin


== Installation ==

Download the plugin and save it on your computer. Unzip the file an upload all file with the wp-multibox folder to your /wp-content/plugin directory.
Browse to the admin plugin site in your wordpress and activate the WP Multibox plugin.
Check "automatic mode" in the settings page or manually set the class of the links to "wmp".

= Settings =

Choice among the MooTools framework versions 1.11, 1.25 and 1.3.
Automatic loading mode, overlay function and bottom control panel are activated upon choice.

The design options are directly set in its settings tab of the admin panel column. Custom colors and borders, overlay color, slideshow control and an additional image folder for icons could be used.
Title and description are set in the "advanced" tab of the image settings. PNGs are transparency proof in Internet Explorer.
Further file extensions, CSS custom class names and the size of iframes could be specified.

Natively supported formats:

* Images (like jpg, bmp, png, gif)
* Flash Video (flv)
* Flash Movie (swf)
* Realmedia (rm, rmvb, rv)
* Windows Media Video (wmv)
* MP3 Music files (mp3)

== Frequently Asked Questions ==

= How can I open a post from my blog into the multibox? =
Enable the WordPress AJAX feature in the plugin settings. Set the attribute 'rel="wpajax:true"' in the trigger link.
Set the ID of the link to: 'yourclass'+'-ajax-'+'targetpost->ID'
e.g. "wmp-ajax-42", or "lightbox-ajax-536"
Multibox will connect to the WordPress native AJAX gateway (admin-ajax.php) and display the post content.
Automatic retrieval of the post ID and content, from a given slug/URL, will be implemented in a future release.

= Can I manually open links in the multibox? =
Yes. When you make a link in the editor of wordpress, use the 'class="wmp"' tag. Example to
open Google in a window: a class="wmp" rel="width:600,height:500" href="http://www.google.com"
When you make use of the rel="" tag, you can set width and height of the multibox frame.

= Can I set a title and description that is displaying only in the multibox? =
Yes: insert an image in your post and click on the settings button of the image. Go to the "advanced" tab and fill out the title and description fields.

= Could the plugin work with image gallery plugins such as Nextgen or Cleaner Gallery? =
Yes: make it use "wmp" or the same class name specified in the WP Multibox settings panel and disable other built-in lightbox scripts.

== Important ==

= Problems with JavaScript =

WP Multibox should not conflict with other plugin or javascript. However, if you javascript errors occur, please make sure other lightbox plugins (such as thickbox, lightbox2, etc) are NOT installed.
Also try so switch the MooTools version in use.

== Screenshots ==

1. The multibox in action
2. Take a look at the configurations page
3. Set title title and description in the editor on the advanced tab 

== Changelog ==

= 1.6 (2011.07.12) =
    * Bugfix: wpajax implement "trigger link id" for MooTools 1.3.2
    * Bugfix: enqueued 1.3 implement file path
    * Scripts in both minified and uncompressed versions

= 1.5 (2011.07.07) =
    * Added type "wpajax"
    * Bugfix: Reworked "onOpen" and "onClose" events, added "onSuccess"
    * Updated MooTools to 1.3.2 and 1.2.5
    * Bugfix: Request.implement for Webkit browsers with MooTools 1.2
    * Removed help link to external site

= 1.4 (first release) =
    * MooTools 1.3 support
    * Multibox plugin script ver.1.3.1
    * scripts enqueued