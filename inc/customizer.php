<?php
/**
 * themefurnace Theme Customizer
 *
 * @package themefurnace
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themefurnace_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // custom handler - textarea
    class themefurnace_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }

}
add_action( 'customize_register', 'themefurnace_customize_register' );


	
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function themefurnace_customize_preview_js() {
	wp_enqueue_script( 'themefurnace_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'themefurnace_customize_preview_js' );




function themefurnace_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themefurnacefooter', array(
        'title' => 'Footer', // The title of section
		'priority'    => 50,
        'description' => 'Footer Text', // The description of section
    ) );
 
  $wp_customize->add_setting( 'themefurnacefooter_footer_text', array(
    'default' => 'Hello world',
    // Let everything else default
) );
$wp_customize->add_control( 'themefurnacefooter_footer_text', array(
    // wptuts_welcome_text is a id of setting that this control handles
    'label' => 'Footer Text',
    // 'type' =>, // Default is "text", define the content type of setting rendering.
    'section' => 'themefurnacefooter', // id of section to which the setting belongs
    // Let everything else default
) );





$wp_customize->add_section( 'themefurnace_logo_section' , array(
    'title'       => __( 'Logo', 'themefurnace' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );


$wp_customize->add_setting( 'themefurnace_logo' );
$wp_customize->add_setting( 'themefurnace_footer_logo' );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themefurnace_logo', array(
    'label'    => __( 'Logo', 'themefurnace' ),
    'section'  => 'themefurnace_logo_section',
    'settings' => 'themefurnace_logo',
) ) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_themefurnace_logo', array(
    'label'    => __( 'Footer Logo', 'themefurnace' ),
    'section'  => 'themefurnace_logo_section',
    'settings' => 'themefurnace_footer_logo',
) ) );


    // $font_choices array from php file
    require_once(dirname(__FILE__).'/google-fonts/fonts.php');


    $wp_customize->add_section( 'google_fonts' , array(
			'title'		=> __( 'Fonts', 'themefurnace'),
			'priority'	=> 50,
		) );

		$wp_customize->add_setting( 'google_fonts_heading_font', array(
			'default'		=> 'none',
			'type'			=> 'theme_mod',
			'capability'	=> 'edit_theme_options',
            'transport'     => 'postMessage'
		) );

		$wp_customize->add_control( 'google_fonts_heading_font', array(
			'label'		=> __( 'Header Font', 'themefurnace' ),
			'section'	=> 'google_fonts',
			'settings'	=> 'google_fonts_heading_font',
			'type'		=> 'select',
			'choices'	=> $font_choices
		) );

		$wp_customize->add_setting( 'google_fonts_body_font', array(
			'default'		=> 'none',
			'type'			=> 'theme_mod',
			'capability'	=> 'edit_theme_options',
            'transport'     => 'postMessage'
		) );

		$wp_customize->add_control( 'google_fonts_body_font', array(
			'label'		=> __( 'Body Font', 'themefurnace'),
			'section'	=> 'google_fonts',
			'settings'	=> 'google_fonts_body_font',
			'type'		=> 'select',
			'choices'	=> $font_choices
		) );



$wp_customize->add_section( 'themefurnace_colors', array(
        'title'          => __( 'Colors', 'themefurnace' ),
        'priority'       => 35,
        ) 
    );
    
$wp_customize->add_setting( 'link_color', array(
        'default'        => '#FF706C',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        ) 
    );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link', array(
    'label'   => __( 'Link color', 'themefurnace' ),
    'section' => 'colors',
    'settings'   => 'link_color',
) ) );

 $wp_customize->add_setting( 'accent_color', array(
        'default'        => '#FF706C',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        ) 
    );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
    'label'   => __( 'Accent color', 'themefurnace' ),
    'section' => 'colors',
    'settings'   => 'accent_color',
) ) );




$wp_customize->add_section( 'themefurnace_footer_scripts_section', array(
    'title' => 'Footer Scripts', // The title of section
    'priority'    => 50,
    //'description' => 'Footer Scripts', // The description of section
) );

$wp_customize->add_setting( 'footer_scripts', array(
    'default'        => '',
) );

$wp_customize->add_control( new themefurnace_Textarea_Control( $wp_customize, 'footer_scripts', array(
    'label'   => 'Footer Scripts',
    'section' => 'themefurnace_footer_scripts_section',
    'settings'   => 'footer_scripts',
) ) );

}
add_action( 'customize_register', 'themefurnace_customizer', 11 );

function themefurnace_customizer_live_preview()
{
    wp_enqueue_script(
        'themefurnace-themecustomizer',			//Give the script an ID
        get_template_directory_uri().'/js/customizer.js',//Point to file
        array( 'jquery','customize-preview' ),	//Define dependencies
        '',						//Define a version (optional)
        true						//Put script in footer?
    );
}
add_action( 'customize_preview_init', 'themefurnace_customizer_live_preview' );