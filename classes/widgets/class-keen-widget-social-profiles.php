<?php
/**
 * Widget List Icons
 *
 * @package Keen Addon
 * @since 1.0.0
 */

if ( ! class_exists( 'Keen_Widget_Social_Profiles' ) ) :

	/**
	 * Keen_Widget_Social_Profiles
	 *
	 * @since 1.0.0
	 */
	class Keen_Widget_Social_Profiles extends WP_Widget {

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
		 * Widget Base
		 *
		 * @since 1.6.0
		 *
		 * @access public
		 * @var string Widget ID base.
		 */
		public $id_base = 'keen-widget-social-profiles';

		/**
		 * Stored data
		 *
		 * @since 1.6.0
		 *
		 * @access private
		 * @var array Widget stored data.
		 */
		private $stored_data = array();

		/**
		 * Initiator
		 *
		 * @since 1.6.0
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
		 * @since 1.6.0
		 */
		function __construct() {
			parent::__construct(
				$this->id_base,
				__( 'Keen: Author Profiles', 'keen-widgets' ),
				array(
					'classname'   => $this->id_base,
					'description' => __( 'Display social profiles.', 'keen-widgets' ),
				),
				array(
					'id_base' => $this->id_base,
				)
			);

			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		}
 

		/**
		 * Register admin scripts
		 *
		 * @return void
		 */
		function register_admin_scripts() {
			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$js_uri  = KEEN_WIDGETS_URI . 'assets/js/' . $dir_name . '/';
			$css_uri = KEEN_WIDGETS_URI . 'assets/css/' . $dir_name . '/';

			wp_enqueue_script( 'keen-widgets-' . $this->id_base, $js_uri . 'keen-widget-social-profiles' . $file_prefix . '.js', array(), KEEN_WIDGETS_VER );
			wp_register_style( 'keen-widget-social-profiles-admin', $css_uri . 'keen-widget-social-profiles-admin' . $file_prefix . '.css' );
		}

		/**
		 * Register scripts
		 *
		 * @return void
		 */
		function register_scripts() {
			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$js_uri  = KEEN_WIDGETS_URI . 'assets/js/' . $dir_name . '/';
			$css_uri = KEEN_WIDGETS_URI . 'assets/css/' . $dir_name . '/';

			wp_register_style( 'keen-widgets-' . $this->id_base, $css_uri . 'keen-widget-social-profiles' . $file_prefix . '.css' );
		}

		/**
		 * Get fields
		 *
		 * @param  string $field Widget field.
		 * @param  mixed  $default Widget field default value.
		 * @return mixed stored/default widget field value.
		 */
		function get_fields( $field = '', $default = '' ) {

			// Emtpy stored values.
			if ( empty( $this->stored_data ) ) {
				return $default;
			}

			// Emtpy field.
			if ( empty( $field ) ) {
				return $default;
			}

			if ( ! array_key_exists( $field, $this->stored_data ) ) {
				return $default;
			}

			return $this->stored_data[ $field ];
		}

		/**
		 * Frontend setup
		 *
		 * @param  array $args Widget arguments.
		 * @param  array $instance Widget instance.
		 * @return void
		 */
		function _front_setup( $args, $instance ) {

			// Set stored data.
			$this->stored_data = $instance;

			// Enqueue Scripts.
			wp_enqueue_style( 'keen-widgets-' . $this->id_base );

			// Enqueue dynamic Scripts.
			wp_add_inline_style( 'keen-widgets-' . $this->id_base, $this->get_dynamic_css() );
		}

		/**
		 * Dynamic CSS
		 *
		 * @return string              Dynamic CSS.
		 */

		 
		function get_dynamic_css() {

			$dynamic_css = '';

			$instances = get_option( 'widget_' . $this->id_base );

			$id_base = '#' . $this->id;

			if ( array_key_exists( $this->number, $instances ) ) {
				$instance = $instances[ $this->number ];

				$icon_color                = isset( $instance['icon-color'] ) ? $instance['icon-color'] : '';
				$bg_color                  = isset( $instance['bg-color'] ) ? $instance['bg-color'] : '';
				$icon_hover_color          = isset( $instance['icon-hover-color'] ) ? $instance['icon-hover-color'] : '';
				$bg_hover_color            = isset( $instance['bg-hover-color'] ) ? $instance['bg-hover-color'] : '';
				$icon_width                = isset( $instance['width'] ) ? $instance['width'] : '';
				$color_type                = isset( $instance['color-type'] ) ? $instance['color-type'] : '';
				$list                      = isset( $instance['list'] ) ? $instance['list'] : '';
				$icons_color               = Keen_Widgets_Helper::get_default_icons_colors();
				$space_btn_icon_text       = isset( $instance['space_btn_icon_text'] ) ? $instance['space_btn_icon_text'] : '';
			
				$dynamic_css               = '';
				// Official Colors only.
				if ( 'official-color' === $color_type ) {

					$new_color_output = '';
					$uniqueue_icon    = array();

					if ( ! empty( $list ) ) {
						foreach ( $list as $index => $list ) {
							$list_data       = json_decode( $list['icon'] );
							$uniqueue_icon[] = $list_data->name;
						}
					}
					if ( ! empty( $uniqueue_icon ) ) {
						foreach ( array_unique( $uniqueue_icon ) as $key => $name ) {
							$icon_color_official    = isset( $icons_color[ $name ] ) ? $icons_color[ $name ]['color'] : '';
							$icon_bg_color_official = isset( $icons_color[ $name ] ) ? $icons_color[ $name ]['bg-color'] : '';

							$trimmed = str_replace( 'keen-icon-', '', $name );

							$color_output = array(
								$id_base . ' .keen-widget-social-profiles-inner.icon-official-color.simple li .' . $name . '.ast-widget-icon svg' => array(
									'fill' => esc_attr( $icon_bg_color_official ),
								),
							
								$id_base . ' .keen-widget-social-profiles-inner.icon-official-color li .' . $name . '.ast-widget-icon svg' => array(
									'fill' => esc_attr( $icon_color_official ),
								),
								$id_base . ' .keen-widget-social-profiles-inner.icon-official-color.circle li .' . $name . '.ast-widget-icon, ' . $id_base . '.keen-widget-social-profiles-inner.icon-official-color.square li .' . $name . '.ast-widget-icon' => array(
									'background-color' => esc_attr( $icon_bg_color_official ),
								),
								$id_base . ' .keen-widget-social-profiles-inner.icon-official-color.square-outline li .' . $name . '.ast-widget-icon svg,' . $id_base . ' .keen-widget-social-profiles-inner.icon-official-color.circle-outline li .' . $name . '.ast-widget-icon svg' => array(
									'fill' => esc_attr( $icon_bg_color_official ),
								),
								$id_base . ' .keen-widget-social-profiles-inner.icon-official-color.square-outline li .' . $name . '.ast-widget-icon, ' . $id_base . ' .keen-widget-social-profiles-inner.icon-official-color.circle-outline li .' . $name . '.ast-widget-icon' => array(
									'border-color' => esc_attr( $icon_bg_color_official ),
								),
							);
							$dynamic_css .= keen_widgets_parse_css( $color_output );
						}
					}
				} else {
					// Custom colors only.
					$css_output = array(
						$id_base . ' .keen-widget-social-profiles-inner li .ast-widget-icon svg' => array(
							'fill' => esc_attr( $icon_color ),
						),
						$id_base . ' .keen-widget-social-profiles-inner li .ast-widget-icon:hover svg' => array(
							'fill' => esc_attr( $icon_hover_color ),
						),
						// square outline.
						$id_base . ' .keen-widget-social-profiles-inner.square-outline li .ast-widget-icon, ' . $id_base . ' .keen-widget-social-profiles-inner.circle-outline li .ast-widget-icon' => array(
							'background'   => 'transparent',
							'border-color' => esc_attr( $bg_color ),
						),
						$id_base . ' .keen-widget-social-profiles-inner.square-outline li .ast-widget-icon svg, ' . $id_base . ' .keen-widget-social-profiles-inner.circle-outline li .ast-widget-icon svg' => array(
							'background' => 'transparent',
							'fill'       => esc_attr( $icon_color ),
						),
						// square & circle.
						$id_base . ' .keen-widget-social-profiles-inner.square .ast-widget-icon, ' . $id_base . ' .keen-widget-social-profiles-inner.circle .ast-widget-icon' => array(
							'background'   => esc_attr( $bg_color ),
							'border-color' => esc_attr( $bg_color ),
						),
						$id_base . ' .keen-widget-social-profiles-inner.square .ast-widget-icon svg, ' . $id_base . ' .keen-widget-social-profiles-inner.circle .ast-widget-icon svg' => array(
							'fill' => esc_attr( $icon_color ),
						),
						$id_base . ' .keen-widget-social-profiles-inner.square .ast-widget-icon:hover svg, ' . $id_base . ' .keen-widget-social-profiles-inner.circle .ast-widget-icon:hover svg' => array(
							'fill' => esc_attr( $icon_hover_color ),
						),
						$id_base . ' .keen-widget-social-profiles-inner.square .ast-widget-icon:hover, ' . $id_base . ' .keen-widget-social-profiles-inner.circle .ast-widget-icon:hover' => array(
							'background'   => esc_attr( $bg_hover_color ),
							'border-color' => esc_attr( $bg_hover_color ),
						),

						// square & circle outline.
						$id_base . ' .keen-widget-social-profiles-inner.square-outline li .ast-widget-icon:hover, ' . $id_base . ' .keen-widget-social-profiles-inner.circle-outline li .ast-widget-icon:hover' => array(
							'background'   => 'transparent',
							'border-color' => esc_attr( $bg_hover_color ),
						),
						$id_base . ' .keen-widget-social-profiles-inner.square-outline li .ast-widget-icon:hover svg, ' . $id_base . ' .keen-widget-social-profiles-inner.circle-outline li .ast-widget-icon:hover svg' => array(
							'fill' => esc_attr( $icon_hover_color ),
						),
					);
					$dynamic_css .= keen_widgets_parse_css( $css_output );
				}

				// Common Property apply to all social icons.
				$common_css_output = array(
					$id_base . ' .keen-widget-social-profiles-inner .ast-widget-icon' => array(
						'font-size' => keen_widget_get_css_value( $icon_width, 'px' ),
					),
					$id_base . ' .keen-widget-social-profiles-inner.circle li .ast-widget-icon, ' . $id_base . ' .keen-widget-social-profiles-inner.circle-outline li .ast-widget-icon' => array(
						'font-size' => keen_widget_get_css_value( $icon_width, 'px' ),
					),
					$id_base . ' .keen-widget-social-profiles-inner li > a .ast-widget-icon' => array(
						'margin-right' => esc_attr( $space_btn_icon_text ) . 'px',
					),
				
					$id_base . ' .keen-widget-social-profiles-inner li:last-child a' => array(
						'margin-right'   => '0',
						'padding-bottom' => '0',
					),
				);
				$dynamic_css      .= keen_widgets_parse_css( $common_css_output );
			}

			return $dynamic_css;
		}

		/**
		 * Widget
		 *
		 * @param  array $args Widget arguments.
		 * @param  array $instance Widget instance.
		 * @return void
		 */
		function widget( $args, $instance ) {

			$this->_front_setup( $args, $instance );
			wp_enqueue_style( 'keen-widgets-font-style' );

			 echo $args['before_widget'];
			   echo $args['before_title'] . $instance['name'] . $args['after_title']; ?>
			  <img src="<?php echo $instance['image_link']; ?>" alt="<?php echo $instance['name']; ?>">
			  <?php 
			 echo  $instance['bio']; 
			echo $args['after_widget'];

			$list             = $this->get_fields( 'list', array() );
			$align            = $this->get_fields( 'align' );
			$icon_color       = $this->get_fields( 'icon-color' );
			$bg_color         = $this->get_fields( 'bg-color' );
			$icon_hover_color = $this->get_fields( 'icon-hover-color' );
			$bg_hover_color   = $this->get_fields( 'bg-hover-color' );
			$icon_style       = $this->get_fields( 'icon-style' );
			$color_type       = $this->get_fields( 'color-type', false );
			$icon             = $this->get_fields( 'icon', false );
			$icon_width       = isset( $instance['width'] ) && ! empty( $instance['width'] ) ? $instance['width'] : '15';
			$title            = apply_filters( 'widget_title', $this->get_fields( 'title' ) );

			// Before Widget.
			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>

			<div class="keen-widget-social-profiles-inner clearfix <?php echo esc_attr( $align ); ?> <?php echo esc_attr( $icon_style ); ?> <?php echo 'icon-' . esc_attr( $color_type ); ?>">
				<?php if ( ! empty( $list ) ) { ?>
					<ul>
						<?php
						foreach ( $list as $index => $list ) {
							$target = ( 'same-page' === $list['link-target'] ) ? '_self' : '_blank';
						
							$list_data = json_decode( $list['icon'] );

							$trimmed = str_replace( 'keen-icon-', '', $list['icon'] );
							?>
							<li>
								<a target="_blank" href="<?php echo esc_url( $list['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
										<span class="ast-widget-icon <?php echo ( is_object( $list_data ) ) ? esc_html( $list_data->name ) : ''; ?>">
											<?php if ( ! empty( $list_data->viewbox ) && ! empty( $list_data->path ) ) { ?>
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="<?php echo ( isset( $list_data->viewbox ) ) ? $list_data->viewbox : ''; ?>" width=<?php echo esc_attr( $icon_width ); ?> height=<?php echo esc_attr( $icon_width ); ?> ><path d="<?php echo ( isset( $list_data->path ) ) ? $list_data->path : ''; ?>"></path></svg>
											<?php } ?>
										</span>
									<?php if ( $display_title ) { ?>
										<span class="link"></span>
									<?php } ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>

			<?php

			// After Widget.
			echo $args['after_widget'];

	 }

		/**
		 * Update
		 *
		 * @param  array $new_instance Widget new instance.
		 * @param  array $old_instance Widget old instance.
		 * @return array                Merged updated instance.
		 */
		function update( $new_instance, $old_instance ) {

			$instance = wp_parse_args( $new_instance, $old_instance );

			

			return $instance;
		}

		/**
		 * Widget Form
		 *
		 * @param  array $instance Widget instance.
		 * @return void
		 */
		function form( $instance ) {

			?>
			<p>
			<label for="">Name</label>
			<input
				class="widefat"
				id="<?php echo $this->get_field_id('name'); ?>"
				name="<?php echo $this->get_field_name('name'); ?>"
				value="<?php echo isset($instance['name']) ? esc_attr($instance['name']) : ''; ?>" 
			  />
			</p>
			
			<p>
				<button class="button button-secondary" id="author_info_image">Upload Image</button>
				<input type="hidden" id="<?php echo $this->get_field_id('image_link'); ?>"  name="<?php echo $this->get_field_name('image_link'); ?>" class="image_er_link" value="<?php echo isset($instance['image_link']) ? esc_url($instance['image_link']) : ''; ?>"
				/>
				<div class="image_show">
					<img src="<?php echo isset($instance['image_link']) ? esc_url($instance['image_link']) : ''; ?>" alt="" width="50" height="50">
				</div>
			</p>
	
			<p>
			<label for="<?php echo $this->get_field_id('bio'); ?>">Bio</label>
			<textarea 
				class="widefat" id="<?php echo $this->get_field_id('bio'); ?>" name="<?php echo    $this->get_field_name('bio'); ?>"><?php echo isset($instance['bio']) ? esc_attr($instance['bio']) : ''; ?>
			</textarea>
			</p>
	
			<?php

			wp_enqueue_script( 'keen-widgets-' . $this->id_base );
			wp_enqueue_style( 'keen-widget-social-profiles-admin' );
			wp_enqueue_style( 'keen-widgets-font-style' );

			$fields = array(
				array(
					'type'    => 'text',
					'id'      => 'title',
					'name'    => __( 'Follow title', 'keen-widgets' ),
					'default' => ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '',
				),
				array(
					'type' => 'separator',
				),
				array(
					'type' => 'heading',
					'name' => __( 'Social Profiles', 'keen-widgets' ),
				),
				array(
					'id'      => 'list',
					'type'    => 'repeater',
					'title'   => __( 'Add Profile', 'keen-widgets' ),
					'options' => array(
					
						array(
							'type'    => 'text',
							'id'      => 'link',
							'name'    => __( 'Link', 'keen-widgets' ),
							'default' => '',
						),
						array(
							'type'    => 'select',
							'name'    => 'Target',
							'id'      => 'link-target',
							'default' => ( isset( $instance['link-target'] ) && ! empty( $instance['link-target'] ) ) ? $instance['link-target'] : 'same-page',
							'options' => array(
								'same-page' => __( 'Same Page', 'keen-widgets' ),
								'new-page'  => __( 'New Page', 'keen-widgets' ),
							),
						),
						// array(
						// 	'type'    => 'select',
						// 	'id'      => 'nofollow',
						// 	'name'    => __( 'No Follow', 'keen-widgets' ),
						// 	'default' => ( isset( $instance['nofollow'] ) && ! empty( $instance['nofollow'] ) ) ? $instance['nofollow'] : 'enable',
						// 	'options' => array(
						// 		'enable'  => __( 'Enable', 'keen-widgets' ),
						// 		'disable' => __( 'Disable', 'keen-widgets' ),
						// 	),
						// ),
						array(
							'type'      => 'icon',
							'id'        => 'icon',
							'name'      => __( 'Icon', 'keen-widgets' ),
							'default'   => '',
							'show_icon' => 'yes',
						),
					),
				),
				array(
					'type' => 'separator',
				),
			
				array(
					'type'    => 'select',
					'id'      => 'align',
					'name'    => __( 'Alignment', 'keen-widgets' ),
					'default' => isset( $instance['align'] ) ? $instance['align'] : '',
					'options' => array(
						'inline' => __( 'Inline', 'keen-widgets' ),
						'stack'  => __( 'Stack', 'keen-widgets' ),
					),
				),
				array(
					'type'    => 'select',
					'id'      => 'icon-style',
					'name'    => __( 'Icon Style', 'keen-widgets' ),
					'default' => isset( $instance['icon-style'] ) ? $instance['icon-style'] : '',
					'options' => array(
						'simple'         => __( 'Simple', 'keen-widgets' ),
						'circle'         => __( 'Circle', 'keen-widgets' ),
						'square'         => __( 'Square', 'keen-widgets' ),
						'circle-outline' => __( 'Circle Outline', 'keen-widgets' ),
						'square-outline' => __( 'Square Outline', 'keen-widgets' ),
					),
				),
				array(
					'type'    => 'select',
					'id'      => 'color-type',
					'name'    => __( 'Icon Color', 'keen-widgets' ),
					'default' => isset( $instance['color-type'] ) ? $instance['color-type'] : '',
					'options' => array(
						'official-color' => __( 'Official Color', 'keen-widgets' ),
						'custom-color'   => __( 'Custom', 'keen-widgets' ),
					),
				),
				array(
					'type'    => 'color',
					'id'      => 'icon-color',
					'name'    => __( 'Icon Color', 'keen-widgets' ),
					'default' => ( isset( $instance['icon-color'] ) && ! empty( $instance['icon-color'] ) ) ? $instance['icon-color'] : '',
				),
				array(
					'type'    => 'color',
					'id'      => 'bg-color',
					'name'    => __( 'Background Color', 'keen-widgets' ),
					'default' => ( isset( $instance['bg-color'] ) && ! empty( $instance['bg-color'] ) ) ? $instance['bg-color'] : '',
				),
				array(
					'type'    => 'color',
					'id'      => 'icon-hover-color',
					'name'    => __( 'Hover Icon Color', 'keen-widgets' ),
					'default' => ( isset( $instance['icon-hover-color'] ) && ! empty( $instance['icon-hover-color'] ) ) ? $instance['icon-hover-color'] : '',
				),
				array(
					'type'    => 'color',
					'id'      => 'bg-hover-color',
					'name'    => __( 'Hover Background Color', 'keen-widgets' ),
					'default' => ( isset( $instance['bg-hover-color'] ) && ! empty( $instance['bg-hover-color'] ) ) ? $instance['bg-hover-color'] : '',
				),
				array(
					'type'    => 'number',
					'id'      => 'width',
					'name'    => __( 'Icon Width:', 'keen-widgets' ),
					'default' => ( isset( $instance['width'] ) && ! empty( $instance['width'] ) ) ? $instance['width'] : '',
					'unit'    => 'Px',
				),
				array(
					'type'    => 'number',
					'id'      => 'space_btn_icon_text',
					'name'    => __( 'Space Between Icon', 'keen-widgets' ),
					'unit'    => 'Px',
					'default' => ( isset( $instance['space_btn_icon_text'] ) && ! empty( $instance['space_btn_icon_text'] ) ) ? $instance['space_btn_icon_text'] : '',
				),
			
			);

			?>

			<div class="<?php echo esc_attr( $this->id_base ); ?>-fields">
				<?php
				// Generate fields.
				keen_generate_widget_fields( $this, $fields );
				?>
				</div>
				<?php

		}

	}

endif;
