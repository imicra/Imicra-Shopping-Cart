<?php
/**
 * Class Helper.
 *
 * @package    Imsc
 * @subpackage Imsc/includes
 * @author     Imicra
 */

namespace imsc\src;

class Helper {

    /**
     * Helper array with templates files names.
     */
    public static function templates_helper_data() {
        $templates = [
            'shop.php' => 'Магазин',
            'cart.php' => 'Корзина',
        ];

        return $templates;
    }
}
