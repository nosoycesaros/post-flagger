![post flagger cover](https://dl.dropboxusercontent.com/u/20749637/wordpress%20plugins/post-flagger/post-flagger.png)
# Post Flagger Wordpress Plugin

Contributors: nosoycesaros
Donate link: https://github.com/nosoycesaros/post-flagger
Tags: flag, post, favorites, views, shortcode, meta, user, log in, admin, link, links
Requires at least: 3.0.1
Tested up to: 4.1.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Favorite or any flag button to your posts or custom Post Types. The easy way.

----

What it does
----


A Wordpress plugin designed to mark posts, pages and Custom Post types with flags, by logged in users. It allows theme developers and administrators create and edit post flags, like favorites, seen, likes, etc. and also provides an easy way to put this flags in your theme via shortcodes.


----

Features
---
* Allows users to mark your posts, pages or Custom Post types with any flags you have defines.
* Administrators can create flags like 'Favorites', 'Seen' or 'Bookmark' for wide use in you wordpress blog/website.
* You can create as many flags as you want.
* Allows customization of output HTML code for each flag (like custom buttons for "faving").
* Painless integration with your custom themes and posts via `[shortcodes]`
* Creates favorite flag and button by default.

-------

Installation
----

1. Upload `post-flagger` folder to the `/wp-content/plugins/` directory or install it through the **wordpress plugin installer**.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place `<?php do_shortcode( '[flag slug="your-flag-slug"]' ); ?>` in your templates or the wordpress editor.
4. Manage flags in `Settings/Post Flags`.

-------

Frequently Asked Questions
----

###Can I delete 'Favorites' flag?

Yes you can

###Why does my html code for "flagged" and "unflagged" states is not showing properly?

Try using your html code whitout any quotes. e.g. `<img src=star.png />`

----

###Changelog

####1.1
* Adds unflag posts feature

####1.0.1
* Bug fixes

####1.0
* Adds support to new language: Spanish
* Allows bulk actions with flags

####0.9
* This is the first release of this plugin
* Add / Edit Post flags for themes
* Creates 'Favorites' flags automaticlly

----


###Upgrade Notice

####1.1
Adds unflag posts feature

####1.0.1
* Important bug fixes

####1.0.0
This upgrade sets basis for 1.x improvements, technically is the first official release.