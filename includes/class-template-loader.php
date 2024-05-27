<?php
/**
 * Template Loader
 *
 * @package    Imsc
 * @subpackage Imsc/includes
 * @author     Imicra
 */

class Imsc_Template_Loader {
    /**
     * Path to template's folder.
     */
    private static $templates_dir;

    /**
     * Templates names.
     */
    private static $templates;

    /**
	 * Hook in methods.
	 */
	public static function init() {
        self::$templates_dir = IMSC_ABSPATH . 'templates';
        self::$templates = self::templates_helper_data();

        add_filter( 'template_include', array( __CLASS__, 'template_loader' ) );
        add_filter( 'theme_page_templates', array( __CLASS__, 'page_templates' ) );
        add_filter( 'display_post_states', array( __CLASS__, 'post_states' ), 10, 2 );
    }

    /**
     * Helper array with templates files names.
     */
    private static function templates_helper_data() {
        $templates = [
            'shop.php' => 'Магазин',
            'cart.php' => 'Корзина',
        ];

        return $templates;
    }

    /**
     * Load a template.
     */
    public static function template_loader( $template ) {
        $page_template = get_page_template_slug();

        $templates = array_diff( scandir( self::$templates_dir ), array('.', '..') );

        foreach( $templates as $tpl ) {
            if ( $tpl === basename( $page_template ) ) {
                return wp_normalize_path( self::$templates_dir . '/' . $tpl );
            }
        }

        return $template;
    }

    /**
     * Page template name.
     */
    public static function page_templates( $templates ) {
        $array_templates = array_diff( scandir( self::$templates_dir ), array('.', '..') );

        foreach( $array_templates as $plugin_template ) {

            foreach ( self::$templates as $template => $name ) {
                if ( $plugin_template === $template ) {
                    $template_name = $name;
                }
            }

            $templates[ $plugin_template ] = $template_name;
        }

        return $templates;
    }

    /**
     * The default post display states used in the posts list table.
     */
    public static function post_states( $post_states, $post ) {
        $post_template = get_post_meta( $post->ID, '_wp_page_template', true );
        $array_templates = array_diff( scandir( self::$templates_dir ), array('.', '..') );

        foreach( $array_templates as $plugin_template ) {
            if ( $plugin_template === $post_template ) {

                foreach ( self::$templates as $template => $name ) {
                    if ( $plugin_template === $template ) {
                        $template_name = $name;
                    }
                }

                $post_states['imbp_tpl'] = sprintf( 'Страница %s', $template_name );
            }
        }

        return $post_states;
    }
}

add_action( 'init', array( 'Imsc_Template_Loader', 'init' ) );
