<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/imicra/
 * @since      1.0.0
 *
 * @package    Imsc
 * @subpackage Imsc/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Imsc
 * @subpackage Imsc/includes
 * @author     Imicra
 */
class Imsc_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        self::create_tables();

        /**
         * Flush the rewrite rules after install or update.
         */
        flush_rewrite_rules();
	}

    public static function create_tables() {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta( self::get_schema() );
    }

    private static function get_schema() {
        global $wpdb;

		$collate = '';

		if ( $wpdb->has_cap( 'collation' ) ) {
			$collate = $wpdb->get_charset_collate();
		}

        $tables = "
        CREATE TABLE {$wpdb->prefix}imsc_products (
            product_id bigint(20) unsigned NOT NULL,
            sku varchar(20) NULL default '',
            price decimal(7,2) NULL DEFAULT NULL,
            PRIMARY KEY (product_id)
        ) $collate;
        CREATE TABLE {$wpdb->prefix}imsc_orders (
            id bigint(20) unsigned NOT NULL auto_increment,
            order_id bigint(20) unsigned NOT NULL,
            customer_id bigint(20) unsigned NOT NULL,
            total_amount decimal(7,2) NULL DEFAULT NULL,
            date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            order_status char(10),
            ship_name varchar(255) NOT NULL,
            ship_address text NOT NULL,
            ship_city varchar(100) NOT NULL,
            ship_zip varchar(20) NULL DEFAULT NULL,
            ship_country varchar(100) NOT NULL,
            PRIMARY KEY (id),
            KEY order_id (order_id),
            KEY customer_id (customer_id)
        ) $collate;
        CREATE TABLE {$wpdb->prefix}imsc_order_items (
            order_id bigint(20) unsigned NOT NULL,
            product_id bigint(20) unsigned NOT NULL,
            item_price decimal(7,2) NOT NULL,
            quantity tinyint unsigned NOT NULL,
            PRIMARY KEY (order_id, product_id)
        ) $collate;
        ";

        return $tables;
    }
}
