<?php
/**
 * The template for displaying Shop page.
 *
 * @package    Imsc
 * @subpackage Imsc/includes
 * @author     Imicra
 */

$myposts = get_posts( array(
    'numberposts' => -1,
    'post_type' => 'imsc_product'
) );

foreach( $myposts as $post ) {
    var_dump( $post );
}

wp_reset_postdata();
