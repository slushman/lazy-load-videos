=== Lazy Load Videos ===
Contributors: slushman
Donate link: http://slushman.com/
Tags: video
Requires at least: 3.0.1
Tested up to: 4.4.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays an image instead of an embedded video. Loads and plays the video when the user clicks on it.



== Description ==

Embed video always gets flagged for performance by tools like PageSpeed. While not embedding a video might be an option, many still need to have a video display in a particular place on the page. Lazy Load Videos displays an image instead of the embedded video, which eliminates the scripts loaded by YouTube, Vimeo, and the like and improving your PageSpeed load times. Lazy Load Videos loads and plays the video when the user clicks on it.

Ecah video has simple configuration: an image, the video URL, and your chosen behavior for when a user clicks on the image (pop-up window, modal window, swap in-place, etc). Videos can be embedded using a shortcode or a template tag.

Lazy Load Videos works with all video services supported by WordPress embeds. See the WordPress Codex [embeds page](https://codex.wordpress.org/Embeds) for the current list.



== Installation ==

1. Upload the lazy-load-videos plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a new embed video in the Videos > Add New menu in WordPress
4. Place either the template tag or shortcode in the appropriate place to display the video.



== Frequently Asked Questions ==

= What happens if I don't choose an image to display? =

If you don't choose an image to display in place of the video, the embedded video will be displayed instead. Embedded videos include scripts that prevent the page from rendering, which is why they get flagged by PageSpeed and other page load tools, so its in your best interest to choose an image.


= Why is there an image in the plugin settings and for each video? =

Each video can its own custom image; the one in the plugin settings is a fallback in case a particular video doesn't have its own custom display image.



== Screenshots ==

1.



== Changelog ==

= 1.0 =
* Initial release.



== Upgrade Notice ==

= 1.0 =
Initial release.