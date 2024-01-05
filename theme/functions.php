<?php

require 'custom.php';

add_action('after_setup_theme', function () {
	remove_action('wp_head', 'feed_links_extra');
	remove_action('wp_head', 'feed_links');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_head', 'rest_output_link_header');
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_resource_hints');
	remove_action('wp_head', 'wp_shortlink_wp_head');

	remove_action('template_redirect', 'rest_output_link_header');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20);

	remove_action('wp_body_open', 'gutenberg_global_styles_render_svg_filters');
	remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
	remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
	remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
	remove_action('wp_footer', 'wp_enqueue_global_styles');

	remove_filter('render_block', 'wp_render_duotone_support');
	remove_filter('render_block', 'wp_render_layout_support_flag');
	remove_filter('render_block', 'wp_restore_group_inner_container');


	//add_filter('get_site_icon_url', '__return_false');
	add_filter('the_generator', '__return_null');
	add_filter('use_block_editor_for_post_type', '__return_false');
});
// add_action( 'do_faviconico', 'magic_favicon_remover');
// function magic_favicon_remover() {
//     exit;
// }
add_action('init', function () {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );	
	remove_action('wp_head', 'wc_gallery_noscript');
	wp_deregister_script('comment-reply');
});

add_action('enqueue_block_assets', function () {
	wp_deregister_style('wc-blocks-style');
	wp_dequeue_style('wc-blocks-style');
});

function woo_dequeue_select2()
{
	if (class_exists('woocommerce')) {
		wp_dequeue_style('select2');
		wp_deregister_style('select2');

		wp_dequeue_script('selectWoo');
		wp_deregister_script('selectWoo');
	}
}
add_action('wp_enqueue_scripts', 'woo_dequeue_select2', 100);


add_action('wp_enqueue_scripts', function () {
	// sort by doesnt work without jquery, find replacement
	//wp_deregister_script('jquery');
	//wp_deregister_script('jquery-core');
	wp_dequeue_script('jquery-blockui');
	wp_deregister_script('wc-cart-fragments');

	wp_deregister_style('woocommerce-inline');
	wp_deregister_style('wp-block-library');
	//wp_deregister_style( 'dashicons' ); 
}, 100);






function display_variation_images() {
    global $product;

    if ($product->is_type('variable')) {
        $available_variations = $product->get_available_variations();

        foreach ($available_variations as $variation) {
            $image_id = $variation['image_id'];
            $image_src = wp_get_attachment_image_src($image_id, 'full')[0];
            echo '<img src="' . $image_src . '" alt="Variation Image">';
        }
    }
}
//add_action('woocommerce_after_add_to_cart_button', 'display_variation_images');





function wc_cart_totals_order_total_html2() {
	$value = '' . WC()->cart->get_total() . ' ';

	// If prices are tax inclusive, show taxes here.
	if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) {
		$tax_string_array = array();
		$cart_tax_totals  = WC()->cart->get_tax_totals();

		if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
			foreach ( $cart_tax_totals as $code => $tax ) {
				$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
			}
		} elseif ( ! empty( $cart_tax_totals ) ) {
			$tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
		}

		if ( ! empty( $tax_string_array ) ) {
			$taxable_address = WC()->customer->get_taxable_address();
			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				$country = WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ];
				/* translators: 1: tax amount 2: country name */
				$tax_text = wp_kses_post( sprintf( __( '(includes %1$s estimated for %2$s)', 'woocommerce' ), implode( ', ', $tax_string_array ), $country ) );
			} else {
				/* translators: %s: tax amount */
				$tax_text = wp_kses_post( sprintf( __( '(includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) );
			}

			$value .= '<small class="includes_tax">' . $tax_text . '</small>';
		}
	}

	echo apply_filters( 'woocommerce_cart_totals_order_total_html', $value ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}




 function woocommerce_quantity_input( $args = array(), $product = null, $echo = true ) {
  
	if ( is_null( $product ) ) {
	   $product = $GLOBALS['product'];
	}
  
	$defaults = array(
	   'input_id' => uniqid( 'quantity_' ),
	   'input_name' => 'quantity',
	   'input_value' => '1',
	   'classes' => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
	   'max_value' => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
	   'min_value' => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
	   'step' => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
	   'pattern' => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
	   'inputmode' => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
	   'product_name' => $product ? $product->get_title() : '',
	);
  
	$args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );
   
	// Apply sanity to min/max args - min cannot be lower than 0.
	$args['min_value'] = max( $args['min_value'], 0 );
	// Note: change 20 to whatever you like
	$args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : 20;
  
	// Max cannot be lower than min if defined.
	if ( '' !== $args['max_value'] && $args['max_value'] < $args['min_value'] ) {
	   $args['max_value'] = $args['min_value'];
	}
   
	$options = '';
	 
	for ( $count = $args['min_value']; $count <= $args['max_value']; $count = $count + $args['step'] ) {
  
	   // Cart item quantity defined?
	   if ( '' !== $args['input_value'] && $args['input_value'] >= 1 && $count == $args['input_value'] ) {
		 $selected = 'selected';      
	   } else $selected = '';
  
	   $options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
  
	}
	  
	$string = '<div class="quantity"><select class="max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" name="' . $args['input_name'] . '">' . $options . '</select></div>';
  
	if ( $echo ) {
	   echo $string;
	} else {
	   return $string;
	}
   
 }










/**
 * plusle functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package plusle
 */

if (!defined('plusle_VERSION')) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define('plusle_VERSION', '0.1.1');
}

// if ( ! defined( 'plusle_TYPOGRAPHY_CLASSES' ) ) {
// 	/*
// 	 * Set Tailwind Typography classes for the front end, block editor and
// 	 * classic editor using the constant below.
// 	 *
// 	 * For the front end, these classes are added by the `plusle_content_class`
// 	 * function. You will see that function used everywhere an `entry-content`
// 	 * or `page-content` class has been added to a wrapper element.
// 	 *
// 	 * For the block editor, these classes are converted to a JavaScript array
// 	 * and then used by the `./javascript/block-editor.js` file, which adds
// 	 * them to the appropriate elements in the block editor (and adds them
// 	 * again when they’re removed.)
// 	 *
// 	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
// 	 * Fields), these classes are added to TinyMCE’s body class when it
// 	 * initializes.
// 	 */
// 	define(
// 		'plusle_TYPOGRAPHY_CLASSES',
// 		'prose prose-neutral max-w-none prose-a:text-primary'
// 	);
// }

if (!function_exists('plusle_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function plusle_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on plusle, use a find and replace
		 * to change 'plusle' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('plusle', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __('Primary', 'plusle'),
				'menu-2' => __('Footer Menu', 'plusle'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support('woocommerce');

		if (class_exists('Woocommerce')) {
			add_filter('woocommerce_enqueue_styles', '__return_empty_array');
		}
		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');
		add_editor_style('style-editor-extra.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', 'plusle_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function plusle_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __('Footer', 'plusle'),
			'id'            => 'sidebar-1',
			'description'   => __('Add widgets here to appear in your footer.', 'plusle'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'plusle_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function plusle_scripts()
{
	wp_enqueue_style('plusle-style', get_stylesheet_uri(), array(), plusle_VERSION);
	wp_enqueue_script('plusle-script', get_template_directory_uri() . '/js/script.min.js', array(), plusle_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'plusle_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
