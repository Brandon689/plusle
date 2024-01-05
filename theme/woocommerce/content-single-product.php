<?php

defined('ABSPATH') || exit;

global $product;

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
woocommerce_output_all_notices();
?>
<div id="product-<?php the_ID(); ?>" class="container mx-auto text-base-content">

	<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
		<div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
			<div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
				<div class="flex flex-col">
					<div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
					<?php
					echo wp_get_attachment_image($product->get_image_id(), 'full');
					?>
					</div>

					<div class="w-32 flex flex-row">
						<?php
						$attachment_ids = $product->get_gallery_image_ids();
						if ($attachment_ids) {
							foreach ($attachment_ids as $attachment_id) {
								echo wp_get_attachment_image($attachment_id, 'full');
							}
						}
						?>
					</div>
				</div>

				<div class="custom-product-details">
					<h1 class="custom-product-title"><?php echo esc_html($product->get_name()); ?></h1>
					<div class="custom-product-price"><?php echo $product->get_price_html(); ?></div>
					<div class="custom-product-description"><?php echo $product->get_description(); ?></div>
					<?php
					if ($product->is_type('variable'))
					{
						woocommerce_variable_add_to_cart();
					}
					elseif ($product->is_type('simple'))
					{
						woocommerce_simple_add_to_cart();	
					}
					?>					
				</div>
			</div>
		</div>


		<?php
		display_variation_images();
		?>
		
	</div>
</div>
