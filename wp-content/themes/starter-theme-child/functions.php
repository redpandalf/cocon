<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action('widgets_init', 'cocon_widgets_init');
		
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		//$context['menu']  = new Timber\Menu();
		$context['site']  = $this;

		$context['main_menu']  = new Timber\Menu('Main Menu');
    $context['footer_menu'] = new Timber\Menu('Footer Menu');

		// Widgets 
		$context['contact_block_bottom'] = Timber::get_widgets('contact_block_bottom');
		
		$context['prefooter_block_legal'] = Timber::get_widgets('prefooter_block_legal');

		$context['footer_block_contact'] 	= Timber::get_widgets('footer_block_contact');
		$context['footer_block_social'] 	= Timber::get_widgets('footer_block_social');
		$context['footer_legal_notice'] 	= Timber::get_widgets('footer_legal_notice');
		//		

		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {

		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );

		$function = new Twig_SimpleFunction('enqueue_style', function () {		
			// Homepage
			if (is_front_page()) {
				wp_enqueue_style('cocon-home', get_stylesheet_directory_uri() . '/static/css/page/home.less');

			} elseif (
					is_page_template('page-massages.php') || 
					is_page_template('page-relaxations.php')
				) {
				wp_enqueue_style('cocon-massages', get_stylesheet_directory_uri() . '/static/css/page/massages-relaxation.less');

			} elseif (is_page_template('page-about.php')) {
				wp_enqueue_style('cocon-qui-suis-je', get_stylesheet_directory_uri() . '/static/css/page/about.less');
			
			} elseif (is_page_template('page-contact.php')) {
				wp_enqueue_style('cocon-contact', get_stylesheet_directory_uri() . '/static/css/page/contact.less');

			} else {
				// by default
				wp_enqueue_style('cocon-default', get_stylesheet_directory_uri() . '/static/css/page/default.less');
			}
	 	});

		$twig->addFunction($function);

		$functionScript = new Twig_SimpleFunction('enqueue_scripts', function () {
			//wp_enqueue_script('ledger', mix('public/js/main.js'), array(), false, true);
			wp_enqueue_script('cocon-script', get_stylesheet_directory_uri() . '/static/site.js');
		});


		$twig->addFunction($functionScript);

		return $twig;
	}


}

new StarterSite();


// Widgets list
function cocon_widgets_init() {

	// Widget Contact Block
	register_sidebar(array(
		'name' 						=> 'Bloc Contact (bas de page)',
		'id'							=> 'contact_block_bottom',
		'description'    => '',
		'class'          => '',
		'before_widget' 	=> '',
		'after_widget' 		=> '',
		'before_title' 		=> '',
		'after_title' 		=> '',
		'before_sidebar'	=> '',
		'after_sidebar' 	=> '',
		'show_in_rest'   => false,
	));

	// Widget Pre Footer - legal notice
	register_sidebar(array(
		'name' 						=> 'Pre Footer : Bloc Mentions Légales',
		'id'							=> 'prefooter_block_legal',
		'description'    => '',
		'class'          => '',
		'before_widget' 	=> '',
		'after_widget' 		=> '',
		'before_title' 		=> '',
		'after_title' 		=> '',
		'before_sidebar'	=> '',
		'after_sidebar' 	=> '',
		'show_in_rest'   => false,
	));

	// Widget Footer Contact Block
	register_sidebar(array(
		'name' 						=> 'Footer : Bloc Contact',
		'id'							=> 'footer_block_contact',
		'description'    => '',
		'class'          => '',
		'before_widget' 	=> '<div class="block-container">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<p class="h3 title">',
		'after_title' 		=> '</p>',
		'before_sidebar'	=> '',
		'after_sidebar' 	=> '',
		'show_in_rest'   => false,
	));
	// Widget Footer Social Network Block
	register_sidebar(array(
		'name' 						=> 'Footer : Bloc Reseau Sociaux',
		'id'							=> 'footer_block_social',
		'description'    => '',
		'class'          => '',
		'before_widget' 	=> '<div class="block-container">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<p class="h3 title">',
		'after_title' 		=> '</p>',
		'before_sidebar'	=> '',
		'after_sidebar' 	=> '',
		'show_in_rest'   => false,
	));
	// Widget Footer Legal notice
	register_sidebar(array(
		'name' 						=> 'Footer : Ligne Mentions Legales',
		'id'							=> 'footer_legal_notice',
		'description'    => '',
		'class'          => '',
		'before_widget' 	=> '',
		'after_widget' 		=> '',
		'before_title' 		=> '',
		'after_title' 		=> '',
		'before_sidebar'	=> '',
		'after_sidebar' 	=> '',
		'show_in_rest'   => false,
	));

}

// Form settings
//
// Remove auto p from Contact Form 7 shortcode output
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
	return false;
}

//function filter_wpcf7_response_output( $output ){
//	// Replace Success CSS Class
//	$output = str_replace( ' wpcf7-mail-sent-ok', ' alert alert-success', $output );
//	return $output; 
//}
//add_filter( 'wpcf7_form_response_output', 'filter_wpcf7_response_output', 10, 1 );

function cf7_add_custom_class( $error ) {
	$error=str_replace("class=\"","class=\"MyClass1 MyClass2 ", $error);
	return $error;
}
add_filter('wpcf7_validation_error', 'cf7_add_custom_class');