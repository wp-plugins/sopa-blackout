=== SOPA Blackout ===
Contributors: eagerterrier
Tags: SOPA, webblackout, blackout, 18th Jan, PIPA, 503
Donate link: http://blog.eagerterrier.co.uk/2012/01/stop-sopa-blackout-wp-plugin/
Requires at least: 2.5
Tested up to: 3.3.1
Stable tag: trunk

Adds temporary 503 status and customisable page on your site to automatically join webblackout day - 18th January 2012

== Description ==

On the Tuesday 24th January 2012, the US Senate will vote on the internet censorship bill.

Whilst it is an American law, it has far reaching repurcusions for the web as a whole. Sites such as Reddit have said that on January 18th they are going to go dark between 8am and 8pm. 

This plugin will let you join the cause. On 18th January your site will display a customisable page.

Search engine rankings will not be affected as the plugin sends a 503 status.

== Installation ==

1. Unzip `sopablackout.zip` and upload the contained files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.4 =
* Errant short PHP tags deleted

= 1.3 =
* Some template/plugin conflict with the plugin. Changed the hook to template_redirect() and added some nocache headers etc.

= 1.2 =
* Slight tweak to the CSS on display page. Didn't like the default blue colour. Made it tie in with americancensorship's green. Adjustment to width of main column.

= 1.1 =
* Adding ability for logged in users/admins to see the SOPA Blackout content.

= 1.0 =
* Initial Upload


== Upgrade Notice ==

= 1.4 =
* Errant short PHP tags deleted

= 1.3 =
* Some template/plugin conflict with the plugin. Changed the hook to template_redirect() and added some nocache headers etc.

= 1.2 =
* Slight tweak to the CSS on display page. Didn't like the default blue colour. Made it tie in with americancensorship's green. Adjustment to width of main column.

= 1.1 =
* Adding ability for logged in users/admins to see the SOPA Blackout content.


== Screenshots ==

1. Screenshot of the administration screen
2. Screenshot of plugin in action.


== Frequently Asked Questions ==

= I can't see my timezone listed. What do I do? =

The timezone option is to be used if you wish to co-ordinate with the US blackout. If you want your site to be blacked out 8am-8pm in your own timezone, leave the timezone option blank.