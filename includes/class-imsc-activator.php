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
        global $wpdb;

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
        CREATE TABLE {$wpdb->prefix}imsc_customers (
            id bigint(20) unsigned NOT NULL auto_increment,
            name varchar(255) NOT NULL,
            email varchar(100) NULL default NULL,
            address text NOT NULL,
            city varchar(100) NOT NULL,
            zip varchar(20) DEFAULT '' NOT NULL,
            country varchar(100) DEFAULT '' NOT NULL,
            PRIMARY KEY (id)
        ) $collate;
        CREATE TABLE {$wpdb->prefix}imsc_products (
            id bigint(20) unsigned NOT NULL auto_increment,
            product_id bigint(20) unsigned NOT NULL,
            price decimal(7,2) NULL DEFAULT NULL,
            PRIMARY KEY (id),
            KEY product_id (product_id)
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
