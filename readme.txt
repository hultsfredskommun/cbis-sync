=== CBIS Sync ===
Contributors: Jonas Hjalmarsson (Hultsfreds kommun)
Tags: cbis, Citybreak, rss, sync, cron
Requires at least: 3.2
Tested up to: 4.2.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CBIS plugin to sync from a Citybreak database to Wordpress posts made by Hultsfreds kommun.

== Description ==

This plugin uses Citybreak Information System (CBIS) to sync articles from selected categories in CBIS to locally created posts in Wordpress. 
First map the CBIS categories you want to sync to one or more of Wordpress Categories. A category has to be mapped to be synced.
Works via wp-cron sync or manually from Settings page.
Title, content (ingress included), images (only Url, no syncing of images) and gps coords. The sync also handles if an article is updated or removed in CBIS.
Contact Jonas Hjalmarsson, Hultsfreds kommun on Twitter @hjalmarsson for questions.


== Installation ==

Download to your WordPress-installation or download and unzip manually to the plugins-folder.

Activate in Plugins section.

Visit the settings page to setup and enable the sync.


== Screenshots ==
1. Settings view for the plugin.
2. Sample of meta values produced of the sync.

== Changelog ==

= 1.0.6 =
Date synced from CBIS PublishedDate and RevisionDate. Author only set and saved first time synced.

= 1.0.5 =
Warning e-mail setting added. Will send a warning when not syncing every 10th time.

= 1.0.4 =
Bugfix, new filter argument added to work with changes in Citybreak API.

= 1.0.3 =
Added dependency check for SoapClient class when activated.

= 1.0.2 =
Settings to append map in content added, to add shortcode for example.

= 1.0.1 =
Image url is moved from being an image in content to the meta field cbis_thumbimageurl and cbis_mediaobject.
GPS is added by appending [karta punkt='xxx,yyy'] to content and meta field cbis_coord.

= 1.0 =
Plugin has been tested. Also added fix to abort when 0 products is found.

= 0.9 =
Initial plugin