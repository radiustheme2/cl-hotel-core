<?php
/**
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals

use RtclStore\Models\Store;
use Rtcl\Helpers\Functions;

extract( $data );

$query               = new \WP_Query( $data['query_args'] );

$cols_list = '';
$cols = [
    'xl' => $data['desktop'],
    'lg' => $data['medium_desktop'],
    'md' => $data['tablet'],
    'sm' => $data['mobile'],
    'xs' => $data['small']
];

foreach( $cols as $key => $value ) {
    $cols_list .= 'row-cols-'.$key.'-'.$value.' ';
}

?>

<div class="rtcl-agents el-agents">
	<div class="row <?php echo esc_attr( $cols_list ); ?> row-cols-1 g-<?php echo esc_attr( $data['columns_gap'] ); ?>">
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post();

				$user_id = get_post_meta( get_the_ID(), '_rtcl_user_id', true );

				if ( ! $user = get_user_by( 'id', $user_id ) ) {
					return;
				}
				$store_id = get_user_meta( $user_id, '_rtcl_store_id', true );
				$name     = trim( implode( ' ', [ $user->first_name, $user->last_name ] ) );
				$name     = $name ? $name : $user->display_name;
				$phone    = get_user_meta( $user_id, '_rtcl_phone', true );
				$pp_id    = absint( get_user_meta( $user_id, '_rtcl_pp_id', true ) );
				$store    = new Store( $store_id );
				?>
				<div class="col">
					<div class="agent-holder">
						<div class="item-img">
							<?php echo $pp_id ? wp_get_attachment_image( $pp_id, 'full' ) : get_avatar( $user_id ) ?>
						</div>
						<div class="item-title">
							<h2 class="agent-name"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html($name); ?></a></h2>
							<h3 class="agency-name"><a href="<?php echo esc_url(get_the_permalink( $store_id )); ?>"><?php echo esc_html(get_the_title( $store_id )); ?></a></h3>
						</div>
						<div class="listing-count">
							<i class="demo-icon rt-custom-icon-list"></i>
							<?php
					// translators: %s: Number of listings.
					printf( esc_html( _n( '%s Listing', '%s Listings', count( $store->get_manager_listing_ids( $user_id ) ), 'cl-hotel-core' ) ), absint( count( $store->get_manager_listing_ids( $user_id ) ) ) );
					?>
						</div>
						<?php
						if($data['show_social_cion']){
							$social_list = Functions::get_user_social_profile($user_id);
								if (!empty($social_list)) { 
							?>
							<div class="item-socials">
								<span><i class="demo-icon rt-custom-icon-share-icon"></i></span>
								<?php
									echo '<ul>';
										foreach ($social_list as $item => $value) {
											?>
											<li>
												<a target="_blank" href="<?php echo esc_url($value) ?>">
													<i class="rtcl-icon rtcl-icon-<?php echo esc_attr($item) ?>"></i>
												</a>
											</li>
											<?php
										}
									echo '</ul>';
								?>
							</div>
						<?php } } ?>
						<span class="shape1"></span>
						<span class="shape2"></span>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</div>

