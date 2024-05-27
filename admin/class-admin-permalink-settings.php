<?php
/**
 * Adds settings to the permalinks admin settings page
 *
 * @package    Imsc
 * @subpackage Imsc/admin
 * @author     Imicra
 */

class Imsc_Admin_Permalink_Settings {

    /**
	 * Hook in tabs.
	 */
	public function __construct() {
		$this->settings_init();
	}

    private function settings_init() {
		add_settings_section( 'imsc-permalink', __( 'Постоянные ссылки Продуктов', 'imsc' ), array( $this, 'settings' ), 'permalink' );
    }

    /**
	 * Show the settings.
	 */
	private function settings() {
        echo 'Здесь можно изменить URL-адреса товаров.';
    }
}

return new Imsc_Admin_Permalink_Settings();
