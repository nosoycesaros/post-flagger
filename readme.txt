=== Post Flagger ===
Contributors: nosoycesaros
Donate link: http://owak.co/post-flagger/
Tags: flag, post, favorites, views, shortcode, meta, user, log in, admin, link, links
Requires at least: 3.0.1
Tested up to: 4.1.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Favorite or any flag button to your posts. The easy way

== Description ==

A Wordpress plugin designed to mark posts by logged in users. Allows theme developers and administrators create and edit post flags, like favorites, seen, likes, etc, also provides an easy way to put this flags in your theme via shortcode.

**Features:**

* Administrators can create flags like 'Favorites', 'Seen' or 'Bookmark' for early use
* You can create as many flags as you want
* Allows customization of HTML code for each flag
* Insert in themes and post via `[shortcode]`
* This plugin creates favorite flag and button by default

== Installation ==

1. Upload `post-flagger` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php do_shortcode( '[flag slug="flag-slug"]' ); ?>` in your templates
4. Manage flags in `Settings/Post Flags`

== Frequently Asked Questions ==

= Can i delete 'Favorites' flag? =

Yes you can

= Why my html code for flagged and unflagged is not showing properly? =

Try using your html code whitout any quotes. e.g.
`<img src=star.png />`

== Screenshots ==

1. Manage your flags in `Settings/Post Flags`
2. Edit each flag separately. It allows HTML

== Changelog ==

= 1.1 =
* Adds unflag posts feature

= 1.0.1 =
* Bug fixes

= 1.0 =
* Adds support to new language: Spanish
* Allows bulk actions with flags

= 0.9 =
* This is the first release of this plugin
* Add / Edit Post flags for themes
* Creates 'Favorites' flags automaticlly

== Upgrade Notice ==

= 1.1 =
* Adds unflag posts feature

= 1.0.1 =
* Important bug fixes

= 1.0 =
This upgrade sets basis for 1.x improvements, technically is the first official release.