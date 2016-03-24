/**
 * Video Finder
 *
 * Finds a video on a page
 * Creates a new video post
 * Gets the coordinates of the top left corner
 * Gets the width and height (iframe attributes)
 * Creates a screenshot of that portion of the screen
 * Saves that as the featured image on the post
 *
 * Gets video title and makes it the video post title:
 * $( "iframe" )[ 0 ].contentWindow.document.title
 * For Vimeo - use the Title attribute on the iframe
 *
 * Gets the URL from the iframe src attribute and makes it the URL on the post
 *
 * Sets the height and width on the video post using the iframe attributes
 *
 * Sets the behavior setting according to the plugin defaults
 *
 * Saves the video post
 *
 * For types of posts, swaps the video URL or embed code with the shortcode from the video post, then saves the post.
 *
 *
 *
 *
 *
 *
 * Idea: replace the oembed process with the above. Display the image instead of the embedded video content.
 */