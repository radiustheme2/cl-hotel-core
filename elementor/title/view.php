<?php
/**
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals

extract( $data );
$align = $data['align'];
$heading_tag_html = sprintf( '<%1$s %2$s class="heading-title">%3$s</%1$s>', $data['heading_tag'], $this->get_render_attribute_string( 'title' ), $data['title'] );

$attr = $tf = '';
if ( !empty( $url['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}
if (!empty($data['title_line_switcher'])) {
    $tf = 'tf';
}

?>
<div class="section-heading <?php echo esc_attr( $tf ); ?>">
	<?php if ( !empty( $data['subtitle'] ) ){ ?>
        <span class="heading-subtitle"><?php echo wp_kses_post( $data['subtitle'] ); ?></span>
    <?php } echo wp_kses_post( $heading_tag_html ); ?>
    <?php echo wp_kses_post( $data['desc'] ); ?>
    <?php if ( !empty( $url['url'] ) ) { ?>
        <div class="btn-wrap btn-v2">
            <a <?php echo $attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="item-btn">
                <?php echo esc_html( $data['btntext'] ); ?>
            </a>
        </div>
	<?php } ?>
</div>