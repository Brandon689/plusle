<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="mt-6">
	<button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
	<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="">
		<?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
	</a>
	</button>
</div>

