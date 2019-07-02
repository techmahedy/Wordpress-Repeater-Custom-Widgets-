<?php
/**
 * Keen Widgets Loader.
 *
 * @package Keen Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Keen_Widgets_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	class Keen_Widgets_Loader {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// Helper.
			require_once KEEN_WIDGETS_DIR . 'classes/class-keen-widgets-helper.php';

			// Add Widget.
			require_once KEEN_WIDGETS_DIR . 'classes/widgets/class-keen-widget-social-follow-link.php';
			require_once KEEN_WIDGETS_DIR . 'classes/widgets/class-keen-widget-address.php';
			require_once KEEN_WIDGETS_DIR . 'classes/widgets/class-keen-widget-list-icons.php';
			require_once KEEN_WIDGETS_DIR . 'classes/widgets/class-keen-widget-social-profiles.php';
			require_once KEEN_WIDGETS_DIR . 'classes/widgets/class-keen-widget-instagram.php';

			add_action( 'widgets_init', array( $this, 'register_list_icons_widgets' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_backend_and_frontend' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_backend_and_frontend' ) );
		}

		/**
		 * Regiter List Icons widget
		 *
		 * @return void
		 */
		function register_list_icons_widgets() {
			register_widget( 'Keen_Widget_Address' );
			register_widget( 'Keen_Widget_List_Icons' );
			register_widget( 'Keen_Widget_Social_Follow_Link' );
			register_widget( 'Keen_Widget_Social_Profiles' );
			register_widget( 'Keen_Widget_Instagram' );
		}

		/**
		 * Regiter Social Icons widget script
		 *
		 * @return void
		 */
		function enqueue_scripts_backend_and_frontend() {
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Keen_Widgets_Loader::get_instance();
