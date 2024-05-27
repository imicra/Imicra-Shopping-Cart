<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/imicra/
 * @since      1.0.0
 *
 * @package    Imsc
 * @subpackage Imsc/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Imsc
 * @subpackage Imsc/includes
 * @author     Imicra
 */
class Imsc_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        flush_rewrite_rules();
	}

}
