<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use RadiusTheme\CLHotel\Helper;

?>

<!-- Search form 1 -->
<div class="cl-hotel-search-form search-form-2 <?php echo esc_attr( $data['css_class'] ); ?>">
	<?php Helper::get_custom_listing_template( 'listing-search', true, compact( 'data' ) ); ?>
</div>
<!-- Search form 1 End -->