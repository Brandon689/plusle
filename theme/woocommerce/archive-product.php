<?php
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
?>
<div class="container mx-auto">
<?php
do_action( 'woocommerce_before_main_content' );
?>
<header class="">
	<?php
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
woocommerce_output_all_notices();
if ( woocommerce_product_loop() ) {

	?><div class="flex justify-between w-96"><?php
	do_action( 'woocommerce_before_shop_loop' );
	?></div>
	<ul class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
	<?php
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'product' );
		}
	}
	?>
	</ul>
	<?php
	do_action( 'woocommerce_after_shop_loop' );
} else {
	do_action( 'woocommerce_no_products_found' );
}
do_action( 'woocommerce_after_main_content' );

?>
</div>
<?php
do_action( 'woocommerce_sidebar' );
get_footer( 'shop' );
