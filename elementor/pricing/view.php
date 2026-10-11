<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals

?>

<div class="rt-pricing-tab">
    <div class="text-center">
        <div class="price-switch-box price-switch-box--style-1">
            <span class="pack-name"><?php echo wp_kses_post($data['m_tab_name']); ?></span>
            <div class="pricing-switch-container">
              <div class="pricing-switch"></div>
              <div class="pricing-switch pricing-switch-active"></div>
              <div class="switch-button"></div>
            </div>
            <span class="pack-name"><?php echo wp_kses_post($data['y_tab_name']); ?> </span>         
        </div>
    </div>
    <div class="rt-tab-content" id="nav-tabContent">
        <div class="rt-tab-pane rtTabFadeInUp">
            <div class="row g-4">
                <?php foreach ( $data['monthly_items'] as $monthly_items ){
                    $target   = $monthly_items['m_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $monthly_items['m_link']['nofollow'] ? ' rel="nofollow"' : '';
                ?>   
                    <div class="col-md-4 col-12">
                        <div class="rt-price-tab-box">
                            <?php if ($monthly_items['badge_text']) { ?>
                                <span class="badge"><?php echo wp_kses_post( $monthly_items['badge_text'] ); ?></span>
                            <?php } ?>
                            <div class="price-header">
                                <h3 class="rt-title"><?php echo wp_kses_post( $monthly_items['m_title'] ); ?></h3>
                                <P class="rt-desc"><?php echo wp_kses_post( $monthly_items['m_desc'] ); ?></P>
                                <h4 class="rt-price"><?php echo wp_kses_post( $monthly_items['m_price'] ); ?></h4>
                                <?php printf( "<div class='btn-wrap btn-v2'><a class='item-btn' href='%s' %s %s >%s</a></div>", esc_url( $monthly_items['m_link']['url'] ), esc_attr( $target ), esc_attr( $nofollow ), esc_html( $monthly_items['m_btn'] ) ); ?>
                            </div>
                            <div class="rt-features-list"><?php echo wp_kses_post( $monthly_items['m_list'] ); ?></div> 
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
                
        <div class="rt-tab-pane rtTabFadeInUp">
            <div class="row g-4">
                <?php foreach ( $data['yearly_items'] as $yearly_items ){
                    $target   = $yearly_items['y_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $yearly_items['y_link']['nofollow'] ? ' rel="nofollow"' : '';
                ?>   
                    <div class="col-md-4 col-12">
                        <div class="rt-price-tab-box">
                            <div class="price-header">
                                <h3 class="rt-title"><?php echo wp_kses_post( $yearly_items['y_title'] ); ?></h3>
                                <P class="desc"><?php echo wp_kses_post( $yearly_items['y_desc'] ); ?></P>
                                <h4 class="rt-price"><?php echo wp_kses_post( $yearly_items['y_price'] ); ?></h4>
                                <?php printf( "<div class='btn-wrap btn-v2'><a class='item-btn' href='%s' %s %s >%s</a></div>", esc_url( $yearly_items['y_link']['url'] ), esc_attr( $target ), esc_attr( $nofollow ), esc_html( $yearly_items['y_btn'] ) ); ?>
                            </div>
                            <div class="rt-features-list"><?php echo wp_kses_post( $yearly_items['y_list'] ); ?></div> 
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
</div>

