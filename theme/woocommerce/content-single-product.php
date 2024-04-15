<?php

defined('ABSPATH') || exit;


add_filter('wp_get_attachment_image_attributes', function($attr, $attachment, $size) {
    // Modify attributes as needed
    $attr['class'] .= ' custom-class'; // Add a custom class
	$attr['onclick'] = 'customChangeImage(this)';
    return $attr;
}, 10, 3);

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
					<div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none berry">
					<?php
						//echo wp_get_attachment_image($product->get_image_id(), 'full');

						$image_src = wp_get_attachment_image_src($product->get_image_id(), 'full');
						if ($image_src) {
							echo '<img id="mainImgReplace" src="' . esc_url($image_src[0]) . '" alt="" width="' . esc_attr($image_src[1]) . '" height="' . esc_attr($image_src[2]) . '">';
						}



					?>
					</div>

					<div class="w-32 flex flex-row">
						<?php
						$attachment_ids = $product->get_gallery_image_ids();
						if ($attachment_ids) {
							foreach ($attachment_ids as $attachment_id) {
								//echo wp_get_attachment_image($attachment_id, 'thumbnail');

								$image_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
								if ($image_src) {
									echo '<img onclick="changeImage(this)" src="' . esc_url($image_src[0]) . '" alt="" width="' . esc_attr($image_src[1]) . '" height="' . esc_attr($image_src[2]) . '">';
								}



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
		<script>
			function changeImage(thumbnail) {
				console.log("ewiokj")
				console.log(thumbnail)
				var mainImage = document.getElementById('mainImgReplace');
				//var mainImage = document.querySelector('.berry img');
				console.log(mainImage)
				mainImage.src = thumbnail.src;
				mainImage.alt = thumbnail.alt;
			}
			</script>
	</div>
</div>
