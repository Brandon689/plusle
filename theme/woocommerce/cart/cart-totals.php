<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2 class="text-lg font-medium text-gray-900"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>



	<dl class="mt-6 space-y-4">
		<div class="flex items-center justify-between">
		<dt class="text-sm text-gray-600"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></dt>
		<dd class="text-sm font-medium text-gray-900" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></dd>
		</div>
		<div class="flex items-center justify-between border-t border-gray-200 pt-4">
		<dt class="flex items-center text-sm text-gray-600">
			<span>Shipping estimate</span>
			<a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
			<span class="sr-only">Learn more about how shipping is calculated</span>
			<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
				<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
			</svg>
			</a>
		</dt>
		<dd class="text-sm font-medium text-gray-900">$5.00</dd>
		</div>
		<div class="flex items-center justify-between border-t border-gray-200 pt-4">
		<dt class="flex text-sm text-gray-600">
			<span>Tax estimate</span>
			<a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
			<span class="sr-only">Learn more about how tax is calculated</span>
			<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
				<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
			</svg>
			</a>
		</dt>
		<dd class="text-sm font-medium text-gray-900">$8.32</dd>
		</div>
		<div class="flex items-center justify-between border-t border-gray-200 pt-4">
		<dt class="text-base font-medium text-gray-900"><?php esc_html_e( 'Order total', 'woocommerce' ); ?></dt>
		<dd class="text-base font-medium text-gray-900" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html2(); ?></dd>
		</div>
	</dl>


	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php //do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
