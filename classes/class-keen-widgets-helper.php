<?php
/**
 * Keen Widgets
 *
 * @package Keen Widgets
 * @since 1.0.0
 */

if ( ! class_exists( 'Keen_Widgets_Helper' ) ) :

	/**
	 * Keen_Widgets_Helper
	 *
	 * @since 1.0.0
	 */
	class Keen_Widgets_Helper {

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * FontAwesome Object
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $json;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		}

		/**
		 * Regiter  widget script
		 *
		 * @param string $hook Page name.
		 * @return void
		 */
		function enqueue_admin_scripts( $hook ) {

			if ( 'widgets.php' !== $hook ) {
				return;
			}

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$js_uri  = KEEN_WIDGETS_URI . 'assets/js/' . $dir_name . '/';
			$css_uri = KEEN_WIDGETS_URI . 'assets/css/' . $dir_name . '/';

			wp_enqueue_style( 'keen-widgets-backend', $css_uri . 'keen-widgets-admin' . $file_prefix . '.css' );
			wp_enqueue_script( 'keen-widgets-backend', $js_uri . 'keen-widgets-backend' . $file_prefix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), KEEN_WIDGETS_VER, true );

			$font_awesome_icons = self::backend_load_font_awesome_icons();

				// Get icons array.
			if ( isset( $font_awesome_icons ) && '' !== $font_awesome_icons ) {

				$translation_array = array(
					'font_awesome' => $font_awesome_icons,
				);

				wp_localize_script( 'keen-widgets-backend', 'fontAwesomeIcons', $translation_array );

			}

		}

		/**
		 * Load Font Awesome Icons
		 *
		 * @since 1.0.0
		 */
		public static function backend_load_font_awesome_icons() {

			if ( ! file_exists( KEEN_WIDGETS_DIR . 'assets/fonts/icons.json' ) ) {
				return array();
			}

			// Function has already run.
			if ( null !== self::$json ) {
				return self::$json;
			}

			$str        = file_get_contents( KEEN_WIDGETS_DIR . 'assets/fonts/icons.json' );
			self::$json = json_decode( $str, true ); // decode the JSON into an associative array.

			return self::$json;
		}

		/**
		 * @param  array $fields Fields array.
		 * @return boolean        Repeater field exist.
		 */
		function have_repeator_field( $fields = array() ) {
			foreach ( $fields as $key => $field ) {
				if ( 'repeater' === $field['type'] ) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Default icons color & bg color
		 *
		 * @return array $icons default icon color & bg color list
		 */
		public static function get_default_icons_colors() {
			$icons = array(
				'facebook'           => array(
					'color'    => '#ffffff',
					'bg-color' => '#3b5998',
				),
				'facebook-f'         => array(
					'color'    => '#ffffff',
					'bg-color' => '#3b5998',
				),
				'facebook-square'    => array(
					'color'    => '#ffffff',
					'bg-color' => '#3b5998',
				),
				'facebook-messenger' => array(
					'color'    => '#ffffff',
					'bg-color' => '#0084ff	',
				),
				'twitter'            => array(
					'color'    => '#ffffff',
					'bg-color' => '#55acee',
				),
				'twitter-square'     => array(
					'color'    => '#ffffff',
					'bg-color' => '#55acee',
				),
				'google-plus'        => array(
					'color'    => '#ffffff',
					'bg-color' => '#dd4b39',
				),
				'google-plus-square' => array(
					'color'    => '#ffffff',
					'bg-color' => '#dd4b39',
				),
				'google-plus-g'      => array(
					'color'    => '#ffffff',
					'bg-color' => '#dd4b39',
				),
				'youtube'            => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff0000',
				),
				'youtube-square'     => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff0000',
				),
				'stumbleupon'        => array(
					'color'    => '#ffffff',
					'bg-color' => '#eb4924',
				),
				'stumbleupon-circle' => array(
					'color'    => '#ffffff',
					'bg-color' => '#eb4924',
				),
				'whatsapp'           => array(
					'color'    => '#ffffff',
					'bg-color' => '#25D366',
				),
				'whatsapp-square'    => array(
					'color'    => '#ffffff',
					'bg-color' => '#25D366',
				),
				'dribbble'           => array(
					'color'    => '#ffffff',
					'bg-color' => '#ea4c89',
				),
				'dribbble-square'    => array(
					'color'    => '#ffffff',
					'bg-color' => '#ea4c89',
				),
				'flickr'             => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff0084',
				),
				'foursquare'         => array(
					'color'    => '#ffffff',
					'bg-color' => '#f94877',
				),
				'slack'              => array(
					'color'    => '#ffffff',
					'bg-color' => '#3aaf85',
				),
				'slack-hash'         => array(
					'color'    => '#ffffff',
					'bg-color' => '#3aaf85',
				),
				'blogger'            => array(
					'color'    => '#ffffff',
					'bg-color' => '#f57d00',
				),
				'blogger-b'          => array(
					'color'    => '#ffffff',
					'bg-color' => '#f57d00',
				),
				'quora'              => array(
					'color'    => '#ffffff',
					'bg-color' => '#b92b27',
				),
				'linkedin'           => array(
					'color'    => '#ffffff',
					'bg-color' => '#007bb5',
				),
				'linkedin-square'    => array(
					'color'    => '#ffffff',
					'bg-color' => '#007bb5',
				),
				'linkedin-in'        => array(
					'color'    => '#ffffff',
					'bg-color' => '#007bb5',
				),
				'skype'              => array(
					'color'    => '#ffffff',
					'bg-color' => '#00AFF0',
				),
				'dropbox'            => array(
					'color'    => '#ffffff',
					'bg-color' => '#007ee5',
				),
				'wordpress'          => array(
					'color'    => '#ffffff',
					'bg-color' => '#21759b',
				),
				'wordpress-simple'   => array(
					'color'    => '#ffffff',
					'bg-color' => '#21759b',
				),
				'vimeo'              => array(
					'color'    => '#ffffff',
					'bg-color' => '#1ab7ea',
				),
				'vimeo-square'       => array(
					'color'    => '#ffffff',
					'bg-color' => '#1ab7ea',
				),
				'vimeo-v'            => array(
					'color'    => '#ffffff',
					'bg-color' => '#1ab7ea',
				),
				'slideshare'         => array(
					'color'    => '#ffffff',
					'bg-color' => '#0077b5',
				),
				'tumblr-square'      => array(
					'color'    => '#ffffff',
					'bg-color' => '#34465d',
				),
				'tumblr'             => array(
					'color'    => '#ffffff',
					'bg-color' => '#34465d',
				),
				'yahoo'              => array(
					'color'    => '#ffffff',
					'bg-color' => '#410093',
				),
				'yahoo'              => array(
					'color'    => '#ffffff',
					'bg-color' => '#410093',
				),
				'instagram'          => array(
					'color'    => '#ffffff',
					'bg-color' => '#e95950',
				),
				'whatsapp'           => array(
					'color'    => '#ffffff',
					'bg-color' => '#4dc247',
				),
				'whatsapp-in'        => array(
					'color'    => '#ffffff',
					'bg-color' => '#4dc247',
				),
				'pinterest'          => array(
					'color'    => '#ffffff',
					'bg-color' => '#cb2027',
				),
				'pinterest-p'        => array(
					'color'    => '#ffffff',
					'bg-color' => '#cb2027',
				),
				'pinterest-square'   => array(
					'color'    => '#ffffff',
					'bg-color' => '#cb2027',
				),
				'pinterest-square'   => array(
					'color'    => '#ffffff',
					'bg-color' => '#cb2027',
				),
				'reddit'             => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff5700',
				),
				'reddit-alien'       => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff5700',
				),
				'reddit-square'      => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff5700',
				),
				'reddit-square'      => array(
					'color'    => '#ffffff',
					'bg-color' => '#ff5700',
				),
				'yelp'               => array(
					'color'    => '#ffffff',
					'bg-color' => '#af0606',
				),
				'behance'            => array(
					'color'    => '#ffffff',
					'bg-color' => '#131418',
				),
				'behance-square'     => array(
					'color'    => '#ffffff',
					'bg-color' => '#131418',
				),
			);
			return $icons;
		}

		/**
		 * Generate fields.
		 *
		 * @param  object $self        Widget object.
		 * @param  array  $fields      Fields array.
		 * @param  string $repeater_id Repeater ID.
		 * @return void
		 */
		function generate( $self, $fields = array(), $repeater_id = '' ) {

			$defaults = array(
				'type'    => '',
				'id'      => '',
				'name'    => '',
				'default' => '',
				'desc'    => '',
			);

			if ( ! empty( $fields ) && is_array( $fields ) ) {
				foreach ( $fields as $key => $value ) {
					$value              = wp_parse_args( $value, $defaults );
					$font_awesome_icons = self::backend_load_font_awesome_icons();

					$class = isset( $value['class'] ) ? $value['class'] : '';

					switch ( $value['type'] ) {
						case 'icon':
							$field_id   = '';
							$field_name = '';

							$decoded_icon_data = json_decode( $value['default'] );
							$encode_icon_data  = $value['default'];

							if ( empty( $repeater_id ) || $this->have_repeator_field( $fields ) ) {
								$field_id   = $self->get_field_id( $value['id'] );
								$field_name = $self->get_field_name( $value['id'] );
							}
							?>
									<div class="keen-widget-icon-selector">
										<?php if ( isset( $value['name'] ) && '' !== $value['name'] ) { ?>
										<label for="<?php echo esc_attr( $field_id ); ?>">
											<?php echo esc_html( $value['name'] ); ?>
										</label>
										<?php } ?>

										<div class="keen-widget-icon-selector-actions">
											<div class="keen-select-icon button"> 
												<?php if ( ! empty( $decoded_icon_data->viewbox ) && ! empty( $decoded_icon_data->path ) ) { ?>
													<div class="keen-selected-icon">
														<svg xmlns="http://www.w3.org/2000/svg" viewBox="<?php echo ( isset( $decoded_icon_data->viewbox ) ) ? esc_attr( $decoded_icon_data->viewbox ) : ''; ?>"><path d="<?php echo ( isset( $decoded_icon_data->path ) ) ? esc_attr( $decoded_icon_data->path ) : ''; ?>"></path></svg>
													</div>
												<?php } ?>
												<?php esc_html_e( 'Choose icon..', 'keen-widgets' ); ?>
											</div>
										</div>


										<div class="keen-icons-list-wrap">
										</div>

										<input class="widefat selected-icon" type="hidden"
											id="<?php echo esc_attr( $field_id ); ?>"
											name="<?php echo esc_attr( $field_name ); ?>"
											value="<?php echo esc_attr( $encode_icon_data ); ?>"
											data-field-id="<?php echo esc_attr( $value['id'] ); ?>"
											data-icon-visible="<?php echo esc_attr( ( isset( $value['show_icon'] ) ) ? $value['show_icon'] : 'no' ); ?>"
										/>
										<span><?php echo $value['desc']; ?></span>
									</div>
								<?php
							break;

				
						case 'checkbox':
							?>
									<div class="keen-widget-field keen-widget-field-checkbox">
										<input class="checkbox" type="checkbox"
											<?php checked( $value['default'] ); ?>
											id="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"
											name="<?php echo esc_attr( $self->get_field_name( $value['id'] ) ); ?>" />
										<label for="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"><?php echo $value['name']; ?></label>
									</div>
									<?php
							break;
						case 'repeater':
							?>
								<div class="keen-repeater">
									<div class="keen-repeater-container">
										<div class="keen-repeater-sortable">
											<?php
											$this->generate_repeater_fields( $self, $fields, $value );
											?>
										</div>
									</div>
									<div class="add-new">
										<button class="add-new-btn button"><?php _e( 'Add item', 'keen-widgets' ); ?></button>
									</div>

									<?php
									$repeater_id = 'widget-' . $self->id_base . '[' . $self->number . '][' . $value['id'] . ']';
									?>

									<div class="keen-repeater-fields" title="<?php echo $value['title']; ?>" data-id="<?php echo esc_attr( $repeater_id ); ?>" style="display: none;">
										<?php $this->generate( $self, $value['options'], $value['id'] ); ?>
									</div>
								</div>
							<?php
							break;

						case 'text':
							$field_id   = '';
							$field_name = '';
							if ( empty( $repeater_id ) || $this->have_repeator_field( $fields ) ) {
								$field_id   = $self->get_field_id( $value['id'] );
								$field_name = $self->get_field_name( $value['id'] );
							}
							?>
										<div class="keen-widget-field keen-widget-field-text">
											<label for="<?php echo esc_attr( $field_id ); ?>">
												<?php echo $value['name']; ?>
											</label>
											<input class="widefat" type="text"
												id="<?php echo esc_attr( $field_id ); ?>"
												name="<?php echo esc_attr( $field_name ); ?>"
												value="<?php echo esc_attr( $value['default'] ); ?>"
												data-field-id="<?php echo esc_attr( $value['id'] ); ?>"
											/>
											<span><?php echo $value['desc']; ?></span>
										</div>
									<?php
							break;
						case 'image':
							$img_url = '';
							if ( ! empty( $value['default'] ) ) {
								if ( strstr( $value['default'], 'http://' ) ) {
									$img_url = $value['default'];
								} else {
									$img_url     = wp_get_attachment_image_src( $value['default'], 'medium' );
										$img_url = $img_url[0];
								}
							}

							$field_id   = '';
							$field_name = '';
							if ( empty( $repeater_id ) || $this->have_repeator_field( $fields ) ) {
								$field_id   = $self->get_field_id( $value['id'] );
								$field_name = $self->get_field_name( $value['id'] );
							}
							?>
									<p>
										<div class="keen-field-image-wrapper">
											<div class="keen-field-image-title" for="<?php echo esc_attr( $field_id ); ?>">
													<?php echo $value['name']; ?>
											</div>
											<div class="keen-field-image">
												<div class="keen-field-image-preview">
													<?php if ( ! empty( $img_url ) ) { ?>
														<span class="keen-remove-image button">Remove</span><img src="<?php echo $img_url; ?>" />
													<?php } ?>
												</div>
												<input
													class="keen-field-image-preview-id"
													id="<?php echo esc_attr( $field_id ); ?>"
													name="<?php echo esc_attr( $field_name ); ?>"
													type="hidden"
													value="<?php echo $value['default']; ?>"
													data-field-id="<?php echo esc_attr( $value['id'] ); ?>">
												<div class="keen-select-image">Choose Image</div>
											</div>
										</div>
									</p>
									<?php
							break;
						case 'radio':
							?>
									<p>
										<label for="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"><?php echo $value['name']; ?></label>
										<?php foreach ( $value['options'] as $option ) { ?>

											<?php
											$c = '';
											if ( $option == $value['default'] ) {
												$c = ' checked="checked" ';
											}
											?>
											<input <?php echo $value['default']; ?> class="widefat" type="radio" <?php echo $c; ?> name="<?php echo $self->get_field_name( $value['id'] ); ?>" value="<?php echo esc_attr( $option ); ?>" />
										<?php } ?>
									</p>
									<?php
							break;
						case 'select':
								$field_id   = '';
								$field_name = '';
							if ( empty( $repeater_id ) || $this->have_repeator_field( $fields ) ) {
								$field_id   = $self->get_field_id( $value['id'] );
								$field_name = $self->get_field_name( $value['id'] );
							}
							?>
								<div class="keen-widget-field keen-widget-field-select keen-widget-field-<?php echo $value['id']; ?>">
									<div class="keen-widget-field-<?php echo esc_attr( $value['id'] ); ?>">
									<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $value['name']; ?></label>
										<select class="widefat" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>"
											data-field-id="<?php echo esc_attr( $value['id'] ); ?>">
											<?php
											foreach ( $value['options'] as $op_val => $op_name ) {
												?>
												<option value="<?php echo $op_val; ?>" <?php selected( $value['default'], $op_val ); ?>><?php echo $op_name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<?php
							break;
						case 'hidden':
							?>
										<input class="<?php echo $class; ?> widefat" type="hidden" id="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>" name="<?php echo esc_attr( $self->get_field_name( $value['id'] ) ); ?>" value="<?php echo esc_attr( $value['default'] ); ?>"/>
									<?php
							break;
						case 'color':
							?>

									<div class="keen-widget-field keen-widget-field-color keen-widget-field-<?php echo $value['id']; ?>">
										<div class="keen-widget-field-<?php echo esc_attr( $value['id'] ); ?>">
											<label for="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"><?php echo $value['name']; ?></label>
											<input class="<?php echo $class; ?> widefat" type="text" id="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>" name="<?php echo esc_attr( $self->get_field_name( $value['id'] ) ); ?>" value="<?php echo esc_attr( $value['default'] ); ?>"/>
										</div>
									</div>

									<?php
							break;
						case 'separator':
							?>
										<hr/>
									<?php
							break;
						case 'heading':
							?>
										<div class="keen-widget-field keen-widget-field-heading">
											<label><?php echo esc_html( $value['name'] ); ?></label>
										</div>
									<?php
							break;
						case 'email':
							?>
										<p>
											<label for="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"><?php echo $value['name']; ?></label>
											<input class="widefat" type="email" id="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>" name="<?php echo esc_attr( $self->get_field_name( $value['id'] ) ); ?>" value="<?php echo esc_attr( $value['default'] ); ?>"/>
										</p>
									<?php
							break;

						case 'textarea':
							?>
										<p>
											<label for="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"><?php echo $value['name']; ?></label>
											<textarea class="widefat" id="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>" name="<?php echo esc_attr( $self->get_field_name( $value['id'] ) ); ?>" rows="5"><?php echo esc_attr( $value['default'] ); ?></textarea>
										</p>
									<?php
							break;

						case 'number':
							?>
										<div class="keen-widget-field keen-widget-field-number keen-widget-field-<?php echo $value['id']; ?> <?php echo $class; ?> <?php echo isset( $value['unit'] ) ? 'keen-widgets-number-unit' : ''; ?> <?php echo( isset( $value['unit'] ) ) ? ' keen-widget-unit-field' : ''; ?>"> 
											<label for="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>"><?php echo $value['name']; ?></label>
											<input class="widefat" type="number" id="<?php echo esc_attr( $self->get_field_id( $value['id'] ) ); ?>" name="<?php echo esc_attr( $self->get_field_name( $value['id'] ) ); ?>" value="<?php echo esc_attr( $value['default'] ); ?>"/><span class="keen-widgets-unit"> <?php echo ( isset( $value['unit'] ) ) ? $value['unit'] : ''; ?> </span>
										</div>
									<?php
							break;

						case 'separator':
							?>
								<hr />
							<?php
							break;
					}
				}
			}
		}

		/**
		 * Generate repeatable fields.
		 *
		 * @param  object $self   Widget object.
		 * @param  array  $fields  Fields array.
		 * @param  array  $value   Default value.
		 * @return void
		 */
		function generate_repeater_fields( $self, $fields, $value ) {
			$instances = $self->get_settings();

			if ( array_key_exists( $self->number, $instances ) ) {
				$instance = $instances[ $self->number ];

				if ( array_key_exists( $value['id'], $instance ) ) {
					$stored           = $instance[ $value['id'] ];
					$repeater_options = $value['options'];
					$repeater_fields  = array();
					foreach ( $repeater_options as $index => $field ) {
						foreach ( $stored as $stored_index => $stored_field ) {
							foreach ( $stored_field as $stored_field_id => $stored_field_value ) {
								if ( $stored_field_id === $field['id'] ) {
									$field['default']                   = $stored_field_value;
									$repeater_fields[ $stored_index ][] = $field;
								}
							}
						}
					}

					// Generate field.
					foreach ( $repeater_fields as $index => $fields ) {
						?>
						<div class="keen-repeater-field">
							<div class="actions">
								<span class="index"><?php echo $index; ?></span>
								<span class="dashicons dashicons-move"></span>
								<span class="title"></span>
								<span class="dashicons dashicons-admin-page clone"></span>
								<span class="dashicons dashicons-trash remove"></span>
								<span class="dashicons toggle-arrow"></span>
							</div>
							<div class="markukp">
								<?php $this->generate( $self, $fields, $value['id'] ); ?>
							</div>
						</div>
						<?php
					}
				}
			}
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Keen_Widgets_Helper::get_instance();

endif;

/**
 * Generate Widget Fields
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'keen_generate_widget_fields' ) ) :

	/**
	 * Wrapper function of `generate()`
	 *
	 * @param  object $self        Widget object.
	 * @param  array  $fields      Fields array.
	 * @param  string $repeater_id Repeater ID.
	 * @return void
	 */
	function keen_generate_widget_fields( $self, $fields = array(), $repeater_id = '' ) {
		Keen_Widgets_Helper::get_instance()->generate( $self, $fields, $repeater_id );
	}
endif;


/**
 * Parse CSS
 */
if ( ! function_exists( 'keen_widgets_parse_css' ) ) {

	/**
	 * Parse CSS
	 *
	 * @param  array  $css_output Array of CSS.
	 * @param  string $min_media  Min Media breakpoint.
	 * @param  string $max_media  Max Media breakpoint.
	 * @return string             Generated CSS.
	 */
	function keen_widgets_parse_css( $css_output = array(), $min_media = '', $max_media = '' ) {

		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( ! count( $properties ) ) {
					continue; }

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' === $value ) {
						continue; }

					$properties_added++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' != $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}
				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}
				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;
			}
		}

		return $parse_css;
	}
}


/**
 * Get CSS value
 */
if ( ! function_exists( 'keen_widget_get_css_value' ) ) {

	/**
	 * Get CSS value
	 * @param  string $value        CSS value.
	 * @param  string $unit         CSS unit.
	 * @param  string $default      CSS default font.
	 * @return mixed               CSS value depends on $unit
	 */
	function keen_widget_get_css_value( $value = '', $unit = 'px', $default = '' ) {

		if ( '' == $value && '' == $default ) {
			return $value;
		}

		$css_val = '';

		switch ( $unit ) {

			case 'px':
			case '%':
						$value   = ( '' != $value ) ? $value : $default;
						$css_val = esc_attr( $value ) . $unit;
				break;

			case 'url':
						$css_val = $unit . '(' . esc_url( $value ) . ')';
				break;

			default:
				$value = ( '' != $value ) ? $value : $default;
				if ( '' != $value ) {
					$css_val = esc_attr( $value ) . $unit;
				}
		}

		return $css_val;
	}
}
