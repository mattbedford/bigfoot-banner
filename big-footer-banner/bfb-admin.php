<?php



if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

//With thanks to https://wp-skills.com/tools/settings-options-page-generator

class BigFooterBanner_Settings_Page {



	public function __construct() {

		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );

		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );

		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );

	}



	public function wph_create_settings() {

		$page_title = 'Big footer banner';

		$menu_title = 'Big footer banner';

		$capability = 'manage_options';

		$slug = 'BigFooterBanner';

		$callback = array($this, 'wph_settings_content');

                $icon = 'dashicons-pets';

		$position = 2;

		add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);

		

	}

    

	public function wph_settings_content() { ?>

		<div class="wrap">

			<h1>Big footer banner</h1>

			<?php settings_errors(); ?>

			<form method="POST" action="options.php">

				<?php

					settings_fields( 'BigFooterBanner' );

					do_settings_sections( 'BigFooterBanner' );

					submit_button();

				?>

			</form>

		</div> <?php

	}



	public function wph_setup_sections() {

		add_settings_section( 'BigFooterBanner_section', 'Tool to add a full-width banner to bottom of your site', array(), 'BigFooterBanner' );

	}



	public function wph_setup_fields() {

		$fields = array(

                    array(

                        'section' => 'BigFooterBanner_section',

                        'label' => 'Banner header',

                        'id' => 'bigfoot_banner_header',

                        'desc' => 'The headline or title that will appear on the big footer banner',

                        'type' => 'text',

                    ),

        

                    array(

                        'section' => 'BigFooterBanner_section',

                        'label' => 'Banner text',

                        'id' => 'bigfoot_banner_text',

                        'desc' => 'The main body text that will appear on the big footer banner',

                        'type' => 'wysiwyg',

                    ),

        

                    array(

                        'section' => 'BigFooterBanner_section',

                        'label' => 'Cookies timeout',

                        'placeholder' => '3',

                        'id' => 'bigfoot_cookies_timeout',

                        'desc' => 'Number of days til the banner is shown again after user dismisses it',

                        'type' => 'number',

                    ),

        

                    array(

                        'section' => 'BigFooterBanner_section',

                        'label' => 'Banner is active',

                        'id' => 'bigfoot_banner_active',

                        'desc' => 'If checked, the banner will be active and visible on the site',

                        'type' => 'checkbox',

                    )

		);

		foreach( $fields as $field ){

			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'BigFooterBanner', $field['section'], $field );

			register_setting( 'BigFooterBanner', $field['id'] );

		}

	}

	public function wph_field_callback( $field ) {

		$value = get_option( $field['id'] );

		$placeholder = '';

		if ( isset($field['placeholder']) ) {

			$placeholder = $field['placeholder'];

		}

		switch ( $field['type'] ) {

            

            

                        case 'checkbox':

                            printf('<input %s id="%s" name="%s" type="checkbox" value="1">',

                                $value === '1' ? 'checked' : '',

                                $field['id'],

                                $field['id']

                        );

                            break;



                        case 'wysiwyg':

                            wp_editor($value, $field['id']);

                            break;



			default:

				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',

					$field['id'],

					$field['type'],

					$placeholder,

					$value

				);

		}

		if( isset($field['desc']) ) {

			if( $desc = $field['desc'] ) {

				printf( '<p class="description">%s </p>', $desc );

			}

		}

	}

    

}

new BigFooterBanner_Settings_Page();