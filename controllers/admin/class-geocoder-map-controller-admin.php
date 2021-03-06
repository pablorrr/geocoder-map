<?php

/**
 * Defines/implements base methods for admin controller classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers/admin
 *
 */
namespace Controllers\Administer;
use Controllers\Geocoder_Map_Controller;
use Includes\Geocoder_Map;

if ( ! class_exists( 'Geocoder_Map_Controller_Admin' ) ) {

	abstract class Geocoder_Map_Controller_Admin extends Geocoder_Map_Controller {

		/**
		 * Render a template
		 *
		 * @param  string $default_template_path The path to the template, relative to the plugin's `views` folder
		 * @param  array  $variables             An array of variables to pass into the template's scope, indexed with the variable name so that it can be extract()-ed
		 * @param  string $require               'once' to use require_once() | 'always' to use require()
		 * @return string
		 *
		 * @since    1.0.0
		 */
		protected static function render_template( $default_template_path = false, $variables = array(), $require = 'once' ){

			if ( ! $template_path = locate_template( basename( $default_template_path ) ) ) {
				$template_path = Geocoder_Map::get_plugin_path() . '/views/admin/' . $default_template_path;
			}

			if ( is_file( $template_path ) ) {
				extract( $variables );
				ob_start();
				if ( 'always' == $require ) {
					require( $template_path );
				} else {
					require_once( $template_path );
				}
				$template_content = apply_filters( 'geocoder_map_template_content', ob_get_clean(), $default_template_path, $template_path, $variables );
			} else {
				$template_content = '';
			}

			return $template_content;
		}

	}

}