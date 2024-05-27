<?php
/**
 * Post Types.
 *
 * Registers post types and taxonomies.
 *
 * @package    Imsc
 * @subpackage Imsc/includes
 * @author     Imicra
 */

class Imsc_Post_Types {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
     * Permalink setting for product.
     */
    private $product_permalink;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        // TODO slug of product's template page
        $this->product_permalink = get_option( 'imsc_product_permalink', 'product' );

	}

	/**
	 * Register core post types.
	 *
	 * @since    1.0.0
	 */
	public function register_post_types() {
        if ( ! is_blog_installed() || post_type_exists( 'imsc_product' ) ) {
			return;
		}

        register_post_type( 'imsc_product', array(
            'labels'              => array(
                'name'               => __( 'Продукты', 'imsc' ),
                'singular_name'      => __( 'Продукт', 'imsc' ),
                'menu_name'          => __( 'Продукты', 'imsc' ),
                'name_admin_bar'     => __( 'Продукты', 'imsc' ),
                'add_new'            => __( 'Добавить Продукт', 'imsc' ),
                'add_new_item'       => __( 'Добавить Новый Продукт', 'imsc' ),
                'new_item'           => __( 'Новый Продукт', 'imsc' ),
                'edit_item'          => __( 'Редактировать Продукты', 'imsc' ),
                'view_item'          => __( 'Смотреть Продукты', 'imsc' ),
                'all_items'          => __( 'Все Продукты', 'imsc' ),
                'search_items'       => __( 'Искать Продукты', 'imsc' ),
                'parent_item_colon'  => __( 'Родительский Продукт', 'imsc' ),
                'not_found'          => __( 'Не найдено Продуктов', 'imsc' ),
                'not_found_in_trash' => __( 'Не найдено Продуктов в корзине.', 'imsc' ),
            ),
            'public'              => true,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'menu_position'       => 30,
            'menu_icon'           => 'dashicons-archive',
            'capability_type'     => 'post',
            // 'map_meta_cap'        => true,
            'hierarchical'        => false,
            'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
            'has_archive'         => false,
            // 'rewrite'             => array( 'slug' => $this->product_permalink, 'with_front' => false ),
            'rewrite'             => false,
            'query_var'           => false,
        ) );

        register_post_type( 'imsc_order', array(
            'labels'              => array(
                'name'               => __( 'Заказы', 'imsc' ),
                'singular_name'      => __( 'Заказ', 'imsc' ),
                'menu_name'          => __( 'Заказы', 'imsc' ),
                'name_admin_bar'     => __( 'Заказы', 'imsc' ),
                'add_new'            => __( 'Добавить Заказ', 'imsc' ),
                'add_new_item'       => __( 'Добавить Новый Заказ', 'imsc' ),
                'new_item'           => __( 'Новый Заказ', 'imsc' ),
                'edit_item'          => __( 'Редактировать Заказы', 'imsc' ),
                'view_item'          => __( 'Смотреть Заказы', 'imsc' ),
                'all_items'          => __( 'Все Заказы', 'imsc' ),
                'search_items'       => __( 'Искать Заказы', 'imsc' ),
                'parent_item_colon'  => __( 'Родительский Заказ', 'imsc' ),
                'not_found'          => __( 'Не найдено Заказов', 'imsc' ),
                'not_found_in_trash' => __( 'Не найдено Заказов в корзине.', 'imsc' ),
            ),
            'public'              => false,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'menu_position'       => 31,
            'menu_icon'           => 'dashicons-bell',
            'capability_type'     => 'post',
            // 'map_meta_cap'        => true,
            'hierarchical'        => false,
            'supports'            => array( 'title' ),
            'has_archive'         => false,
            'rewrite'             => false,
            'query_var'           => false,
        ) );

        register_post_type( 'imsc_customers', array(
            'labels'              => array(
                'name'               => __( 'Покупатели', 'imsc' ),
                'singular_name'      => __( 'Покупатель', 'imsc' ),
                'menu_name'          => __( 'Покупатели', 'imsc' ),
                'name_admin_bar'     => __( 'Покупатели', 'imsc' ),
                'add_new'            => __( 'Добавить Покупатель', 'imsc' ),
                'add_new_item'       => __( 'Добавить Новый Покупатель', 'imsc' ),
                'new_item'           => __( 'Новый Покупатель', 'imsc' ),
                'edit_item'          => __( 'Редактировать Покупатели', 'imsc' ),
                'view_item'          => __( 'Смотреть Покупатели', 'imsc' ),
                'all_items'          => __( 'Все Покупатели', 'imsc' ),
                'search_items'       => __( 'Искать Покупатели', 'imsc' ),
                'parent_item_colon'  => __( 'Родительский Покупатель', 'imsc' ),
                'not_found'          => __( 'Не найдено Покупателей', 'imsc' ),
                'not_found_in_trash' => __( 'Не найдено Покупателей в корзине.', 'imsc' ),
            ),
            'public'              => false,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'menu_position'       => 32,
            'menu_icon'           => 'dashicons-groups',
            'capability_type'     => 'post',
            // 'map_meta_cap'        => true,
            'hierarchical'        => false,
            'supports'            => array( 'title' ),
            'has_archive'         => false,
            'rewrite'             => false,
            'query_var'           => false,
        ) );
	}

}
