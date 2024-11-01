=== Universal Slugs ===
Contributors: ac_humbucker
Tags: utf, greek, localization, permalinks, slugs
Requires at least: 2.7.2
Tested up to: 3.0
Stable tag: 0.6

This plugins will create URL-friendly slugs for your posts, from your title, regardless of language and special characters.

== Description ==

Wordpress is brilliantly designed for SEO but, if you happen to speak a language that uses characted that are not included on the English alphabet, then you either have to bear with massive, odd looking permalinks, or manually update each one whenever you write a post or a page.

Universal Slugs fixes this problem by hooking into your normal workflow and fixing the auto-generated urls behind the scenes.

The plugin will also remove common words such as "and", "και", "το", "the" etc. from the URLs, as they do simply contribute to the URL length without adding anything to the meaning or the SEO value.

== Installation ==

1. Unzip `universal-slugs.zip` and upload the `universal-slugs` older to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Make sure you have correctly specified  you blog's language in `wp-config.php`
   `define("WPLANG","el_GR");`
4. Slugs will be automatically normalized when you save your posts, you don't have to do anything.
   NOTE: The slug will not be updated the VERY FIRST TIME you update a post. That is ok, the update will happen every time after the first!

== Frequently Asked Questions ==

= Can you add support for my language? =

Sure, but help with the list of stopwords will definately help.
You can speed up the process by using `mapping-tool.php` to create the mappings and stopwords and sending it to us, we will them incorporate your language to Universal Slugs as soon as possible.

== Changelog ==

= 0.6 =
* Rewrote to support multiple localization data

= 0.5 =
* Added Greek stopwords to be removed from slugs

= 0.3 =
* PHP4+ compatibility, wordpress 2.6+ compatibility

= 0.2 =
* First version. Greek only, PHP5+

== Upgrade Notice ==
= 0.6 =
First Wordpress hosted release, if you already have a version of the plugin downloaded from the Humbucker Website, please remove and install this official release.

== Screenshots ==
No screenshots available at this time.