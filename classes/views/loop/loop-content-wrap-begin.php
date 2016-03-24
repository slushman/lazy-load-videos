<?php
/**
 * The view for the content wrap start used in the loop
 */

?><button
	aria-label="<?php echo esc_attr( $item->post_title ); ?>"
	class="llv-video <?php echo $class; ?>"
	data-videoid="<?php echo esc_attr( $item->post_ID ); ?>"
	id="llv-video-<?php echo esc_attr( $item->post_ID ); ?>">