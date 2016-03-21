<?php

/**
 * Displays the publishing metabox
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Lazy_Load_Videos
 * @subpackage Lazy_Load_Videos/classes/views
 */

?><p><?php

esc_html_e( 'Shortcode:', 'lazy-load-videos' );

?><pre>[llvideo id="<?php echo get_the_id(); ?>"]</pre>
</p>
<p><?php

esc_html_e( 'Template Tag:', 'lazy-load-videos' );

?><pre><?php echo '&lt;?php echo llvideo(' . get_the_id() . '); ?&gt;'; ?></pre>
</p>
