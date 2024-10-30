=== LH Native Lazy Loading ===
Contributors: shawfactor
Tags: lazy load, lazyload, loading, performance, images
Requires at least: 5.2
Tested up to: 5.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically add the new `loading` attribute to images and oembeded iframes within your content to support native image lazy loading.

== Description ==
This plugin adds the `loading` attribute to IMG and IFRAME tags found when filtering `the_content()`, post thumbnails, and oembed to support native lazy loading.

The latest version of Chrome (76) now supports this attribute and more browsers will follow in time.

For more information about lazy loading images using this new native browser image attribute, check out this article: [https://addyosmani.com/blog/lazy-loading/](https://addyosmani.com/blog/lazy-loading/).


The `loading` attribute instructs a browser to defer loading offscreen images until users scroll near them. It comes in three flavors: **eager**, **auto**, and **lazy**.  Install this plugin and it will automatically add the attribute where appropriate.

**Simple is Beautiful**

There is no JavaScript or CSS included in the plugin.  It just works in browsers that support the new `loading` image attribute.

For browsers that don't support this new image loading attribute. You can still use a JavaScript-based image lazy loader as a fallback until browser support becomes more mainstream.

**Requires wp_body_open**

Note this plugin requires wordpress 5.2 and for your theme to support the wp_body_open hook (most good themes do).

== Installation ==

1. Install **LH Native Lazy Loading** from the WordPress repo
1. Activate the plugin through the **Plugins** menu
1. That is it, there are no settings it just works!!

== Frequently Asked Questions ==
= Does this add any JS? =
No.  If you're using another JS-based lazy loader, that'll just keep working as it did.  If the browser doesn\'t support the `loading` attribute, it'll just ignore it and process per usual.

== Changelog ==

**1.00 August 09, 2019**  
Initial release.