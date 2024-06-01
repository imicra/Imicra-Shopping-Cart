<?php
/**
 * Meta Boxes.
 *
 * @package    Imsc
 * @subpackage Imsc/admin
 * @author     Imicra
 */

class Admin_Meta_Boxes {

    /**
	 * Constructor.
	 */
	public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

        // Save Product Meta Boxes.
		add_action( 'imsc_process_imsc_product_meta', array( $this, 'product_save_meta_boxes' ), 10 );
    }

    /**
	 * Add WC Meta boxes.
	 */
    public function add_meta_boxes() {
        add_meta_box( 'imsc_product', __( 'Данные товара', 'imsc' ), array( $this, 'meta_box_product' ), 'imsc_product', 'normal' );
    }

    /**
     * Output the metabox.
     *
     * @param  object $post Post object.
     */
    public function meta_box_product( $post ) {
        global $wpdb;

        $table = "{$wpdb->prefix}imsc_products";
        $result = $wpdb->get_row(
            "
            SELECT * FROM $table
            WHERE product_id = $post->ID
            "
        );

        echo '<p class="form-field">';
        echo '<label for="sku">Номер в каталоге (CAT)</label>';
        echo '<input type="text" class="sku" style="" name="sku" id="sku" value="' . $result->sku . '" placeholder="" /> ';
        echo '</p>';

        echo '<p class="form-field">';
        echo '<label for="price">Цена</label>';
        echo '<input type="text" class="price" style="" name="price" id="price" value="' . $result->price . '" placeholder="" /> ';
        echo '</p>';
    }

    /**
	 * Check if we're saving, the trigger an action based on the post type.
	 *
	 * @param  int    $post_id Post ID.
	 * @param  object $post Post object.
	 */
    public function save_meta_boxes( $post_id, $post) {
        if ( ! in_array( $post->post_type, array( 'imsc_product' ), true ) ) {
            return;
        }

        /**
         * Save meta for post type.
         *
         * @param int $post_id Post ID.
         * @param object $post Post object.
         */
        do_action( 'imsc_process_' . $post->post_type . '_meta', $post_id, $post );
    }

    /**
	 * Save product meta box data.
	 *
	 * @param int     $post_id WP post id.
	 */
    public function product_save_meta_boxes( $post_id ) {
        global $wpdb;

        $table = "{$wpdb->prefix}imsc_products";
        $update = $wpdb->get_row(
            "
            SELECT * FROM $table
            WHERE product_id = $post_id
            "
        );

        if ( isset( $_REQUEST['sku'] ) || isset( $_REQUEST['price'] ) ) {
            if ( $update ) {
                $wpdb->update(
                    $table,
                    [
                        'sku'   => $_REQUEST['sku'],
                        'price' => $_REQUEST['price']
                    ],
                    ['product_id' => $post_id],
                    ['%s', '%f'],
                    '%d'
                );
            } else {
                $wpdb->insert(
                    $table,
                    [
                        'product_id' => $post_id,
                        'sku'        => $_REQUEST['sku'],
                        'price'      => $_REQUEST['price']
                    ],
                    ['%d', '%s', '%f']
                );
            }
        }
    }
}

new Admin_Meta_Boxes();
