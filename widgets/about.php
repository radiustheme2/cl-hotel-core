<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\CL_Hotel_Core;

use \WP_Widget;
use \RT_Widget_Fields;

class RT_about_Widget extends WP_Widget {
	public function __construct() {
		$id = CL_HOTEL_CORE_THEME_PREFIX . '_about';
		parent::__construct(
            $id, // Base ID
            esc_html__( 'A1: About', 'cl-hotel-core' ), // Name
            array( 'description' => esc_html__( 'Hotel: About Widget', 'cl-hotel-core' )
        ) );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );

		$title = $instance['title'];
		$desc = $instance['desc'] ? $instance['desc'] : '';
		$phone = $instance['phone'] ? $instance['phone'] : '';
		$email = $instance['email'] ? $instance['email'] : '';
		?>

		<div class="widget-about">
			<?PHP if ( ! empty( $instance['title'] ) ) { ?>
			<div class="footer-logo">
				<?php
					$html = apply_filters( 'widget_title', $instance['title'] );
					echo $args['before_title'] . $html . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</div>
			<?php } if (!empty($desc)) { ?>
				<p class="footer-text address"><?php echo wp_kses_stripslashes( $desc ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php } if (!empty($phone)) { ?>
				<p class="footer-text phone"><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo wp_kses_stripslashes( $phone ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
			<?php } if (!empty($email)) { ?>
				<p class="footer-text email"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo wp_kses_stripslashes( $email ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
			<?php } ?>
		</div>

        <?php 
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance          = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['desc']  = ( ! empty( $new_instance['desc'] ) ) ? sanitize_text_field( $new_instance['desc'] ) : '';
		$instance['phone']  = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';
		$instance['email']  = ( ! empty( $new_instance['email'] ) ) ? sanitize_text_field( $new_instance['email'] ) : '';

		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'  	 => '',
			'desc'       => '',
			'phone'      => '',
			'email'      => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'       => array(
				'label'   => esc_html__( 'Title', 'cl-hotel-core' ),
				'type'    => 'text',
			),
			'desc'        => array(
				'label'   => esc_html__( 'Address', 'cl-hotel-core' ),
				'type'    => 'textarea',
			),
			'phone'        => array(
				'label'   => esc_html__( 'Phone', 'cl-hotel-core' ),
				'type'    => 'text',
			),
			'email'        => array(
				'label'   => esc_html__( 'Email', 'cl-hotel-core' ),
				'type'    => 'text',
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}